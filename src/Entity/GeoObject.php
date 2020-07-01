<?php

namespace App\Entity;

class GeoObject
{
    private $geoCoderMetaData;
    private $point;
    private $name;
    private $description;

    public function __construct($point, $name, $description, $geoCoderMetaData)
    {
        $this->name = $name;
        $this->description = $description;
        $this->point = $point;
        $this->geoCoderMetaData = $geoCoderMetaData;
    }

    public function getGeoCoderMetaData(): ?GeocoderMetaData
    {
        return $this->geoCoderMetaData;
    }

    public function setGeoCoderMetaData(GeocoderMetaData $geoCoderMetaData)
    {
        $this->geoCoderMetaData = $geoCoderMetaData;
    }

    public function getPoint(): ?Point
    {
        return $this->point;
    }

    public function setPoint(Point $point)
    {
        $this->point = $point;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}