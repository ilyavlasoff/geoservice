<?php

namespace App\Entity\ApiResponse;

use phpDocumentor\Reflection\Types\This;

class ApiResponse
{
    private $structAddress;
    private $longitude;
    private $latitude;
    private $metro;

    /**
     * @return string|null
     */
    public function getStructAddress(): ?string
    {
        return $this->structAddress;
    }

    /**
     * @param string $structAddress
     */
    public function setStructAddress(string $structAddress)
    {
        $this->structAddress = $structAddress;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string|null
     */
    public function getMetro(): ?string
    {
        return $this->metro;
    }

    /**
     * @param string $metro
     */
    public function setMetro(string $metro)
    {
        $this->metro = $metro;
    }

}