<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\SerializedName;

class GeocoderMetaData
{
    private $kind;
    private $text;
    private $precision;

    /**
     * @SerializedName("Address")
     * @var Address
     */
    private $address;

    /**
     * @return string|null
     */
    public function getKind(): ? string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return string|null
     */
    public function getText(): ? string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string|null
     */
    public function getPrecision(): ? string
    {
        return $this->precision;
    }

    /**
     * @param string $precision
     */
    public function setPrecision(string $precision)
    {
        $this->precision = $precision;
    }

    /**
     * @return Address
     */
    public function getAddress(): ? Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }
}