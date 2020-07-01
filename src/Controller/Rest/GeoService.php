<?php

namespace App\Controller\Rest;

use App\Entity\ApiResponse\ApiResponse;
use App\Service\HttpGeoCoderClient;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeoService extends AbstractController
{
    /**
     * @Rest\Post(path="/api/address", name="get_address_data_rest")
     * @Rest\RequestParam(
     *     name="address",
     *     nullable=false,
     *     description="The keyword to search for."
     * )
     * @Rest\RequestParam(
     *     name="lang",
     *     nullable=true,
     *     requirements="(ru_RU|uk_UA|be_BY|en_RU|en_US)",
     *     default="en_US",
     *     description="Язык, на котором будет выдаваться ответ"
     * )
     * @Rest\RequestParam(
     *     name="count",
     *     nullable=false,
     *     description="Количество выдаваемых результатов в одном ответе"
     * )
     *  @Rest\RequestParam(
     *     name="offset",
     *     nullable=false,
     *     description="Количество пропускаемых результатов в начале ответа"
     * )
     * @return View
     */
    public function getAddressData(ParamFetcher $paramFetcher, HttpGeoCoderClient $apiClient): View
    {
        try
        {
            $requiredAddress = $paramFetcher->get('address');
            $language = $paramFetcher->get('lang');
            $count = $paramFetcher->get('count');
            $offset = $paramFetcher->get('offset');
        }
        catch (\RuntimeException $ex)
        {
            return View::create(['error'=> 'Bad request'], Response::HTTP_BAD_REQUEST);
        }
        try
        {
            $stringPlacedResult = $apiClient->getDataWithAddress($requiredAddress, $count, $offset, $language);
        }
        catch (\Exception $ex)
        {
            return View::create(['error'=> 'Response can not be received'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $receivedData = [];
        if ($geoObjects = $stringPlacedResult->getGeoObjects())
        {
            foreach ($geoObjects as $geoObject) {
                $receivedItem = new ApiResponse();

                $receivedItem->setStructAddress($geoObject->getGeoCoderMetaData()->getAddress()->getFormatted());

                $coordinates = $geoObject->getPoint()->getCoordinates();
                $receivedItem->setLatitude($coordinates['latitude']);
                $receivedItem->setLongitude($coordinates['longitude']);

                try
                {
                    $coordsPlacedResult = $apiClient->getDataWithCoords($coordinates['longitude'], $coordinates['latitude'], 1, 0, $language, 'metro');
                }
                catch (\Exception $ex)
                {
                    return View::create(['error'=> 'Response can not be received'], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
                if (!empty($geoObjectArray = $coordsPlacedResult->getGeoObjects())) {
                    $receivedItem->setMetro($coordsPlacedResult->getGeoObjects()[0]->getName());
                }
                $receivedData[] = $receivedItem;
            }
        }

        return View::create(['count' => count($receivedData), 'data' => $receivedData], Response::HTTP_OK);
    }
}