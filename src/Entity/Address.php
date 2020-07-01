<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Address
{
    /**
     * @SerializedName("country_code")
     * @var string|null
     */
    private $countryCode;
    private $formatted;
    private $postalCode;
    /*
     * @SerializedName("Components")
     * @var array
     */
    //private $components;

    /**
     * @return string|null
     */
    public function getCountryCode(): ? string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string|null
     */
    public function getFormatted(): ? string
    {
        return $this->formatted;
    }

    /**
     * @param string $formatted
     */
    public function setFormatted(string $formatted)
    {
        $this->formatted = $formatted;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ? string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }
}