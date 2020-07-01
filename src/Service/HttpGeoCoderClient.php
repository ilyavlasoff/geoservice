<?php

namespace App\Service;
use App\Entity\GeocoderMetaData;
use App\Entity\GeocoderResponseMetaData;
use App\Entity\GeoData;
use App\Entity\GeoObject;
use App\Entity\Point;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HttpGeoCoderClient
{
    private $params;
    private $serializer;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
        $encoder = [new JsonEncoder()];
        $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $normalizer = [new ArrayDenormalizer(), new ObjectNormalizer(null, null, null, $extractor)];
        $this->serializer = new Serializer($normalizer, $encoder);
    }

    public function getDataWithAddress(string $address, int $results, int $skip, string $lang): ?GeoData
    {
        $receivedData = $this->getData($address, $results, $skip, $lang);
        if(! $receivedData)
        {
            throw new \Exception("Response wasn't received");
        }
        $response = json_decode($receivedData);
        return $this->deserializeData($response);
    }

    public function getDataWithCoords(float $longitude, float $latitude, int $results, int $skip, string $lang, string $kind): ?GeoData
    {
        if (abs($longitude) > 180 || abs($latitude) > 180)
        {
            throw new \Exception("Coordinates data is not valid");
        }

        $receivedData = $this->getData("{$longitude}, {$latitude}", $results, $skip, $lang, $kind);
        if(! $receivedData)
        {
            throw new \Exception("Response wasn't received");
        }
        $response = json_decode($receivedData);
        return $this->deserializeData($response);
    }

    private function getData(string $geoData, int $results, int $skip, string $lang, string $kind = null, string $format = 'json'): string
    {
        $httpClient = HttpClient::create();

        $apiKey = $this->params->get('apiKey');
        $domain = $this->params->get('apiSourceDomain');

        if (! $apiKey || ! $domain)
        {
            throw new \Exception('Configuration data was not received');
        }

        $params = [
            'format' => $format,
            'apikey' => $apiKey,
            'geocode' => $geoData,
            'results' => $results,
            'skip' => $skip,
            'lang' => $lang
        ];
        if($kind)
        {
            $params['kind'] = $kind;
        }
        $url = $domain . '?' . http_build_query($params);
        $response = $httpClient->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 300)
        {
            throw new \Exception('An error occured');
        }

        return $response->getContent(false);
    }

    private function deserializeData($response): ?GeoData
    {
        $receivedResponseData = new GeoData();
        $geoCoderResponseMetaData = $this->serializer->deserialize(json_encode($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData),
            GeocoderResponseMetaData::class, 'json');
        if($geoCoderResponseMetaData instanceof GeocoderResponseMetaData)
        {
            $receivedResponseData->setMeta($geoCoderResponseMetaData);
        }

        foreach ($response->response->GeoObjectCollection->featureMember as $item)
        {
            $geoCoderMetaData = $this->serializer->deserialize(json_encode($item->GeoObject->metaDataProperty->GeocoderMetaData),
                GeocoderMetaData::class, 'json');

            $point = $this->serializer->deserialize(json_encode($item->GeoObject->Point), Point::class, 'json');
            $name = $item->GeoObject->name;
            $description = $item->GeoObject->description;
            $receivedResponseData->addGeoObject(new GeoObject($point, $name, $description, $geoCoderMetaData));
        }

        return $receivedResponseData;
    }
}