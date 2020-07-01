<?php

namespace App\Entity;

class GeoData
{
    /**
     * @var GeocoderResponseMetaData
     */
    private $meta;

    /**
     * @var GeoObject[]
     */
    private $geoObjects;

    public function getMeta(): ?GeocoderResponseMetaData
    {
        return $this->meta;
    }

    public function setMeta(GeocoderResponseMetaData $meta)
    {
        $this->meta = $meta;
    }

    public function getGeoObjects(): ?array
    {
        return $this->geoObjects;
    }

    public function setGeoObjects(array $geoObjects)
    {
        $this->geoObjects = $geoObjects;
    }

    public function addGeoObject(GeoObject $geoObject)
    {
        $this->geoObjects[] = $geoObject;
    }
}