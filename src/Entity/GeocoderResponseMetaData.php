<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\SerializedName;

class GeocoderResponseMetaData
{
    /**
     * @SerializedName("request")
     * @var string|null
     */
    private $request;

    /**
     * @SerializedName("suggest")
     * @var string|null
     */
    private $suggest;

    /**
     * @SerializedName("found")
     * @var string|null
     */
    private $found;

    /**
     * @SerializedName("results")
     * @var string|null
     */
    private $results;

    /**
     * @SerializedName("skip")
     * @var string|null
     */
    private $skip;

    /**
     * @return string|null
     */
    public function getRequest(): ? string
    {
        return $this->request;
    }

    /**
     * @param string $request
     */
    public function setRequest(string $request)
    {
        $this->request = $request;
    }

    /**
     * @return string|null
     */
    public function getSuggest(): ? string
    {
        return $this->suggest;
    }

    /**
     * @param string $suggest
     */
    public function setSuggest(string $suggest)
    {
        $this->suggest = $suggest;
    }

    /**
     * @return string|null
     */
    public function getFound(): ? string
    {
        return $this->found;
    }

    /**
     * @param string $found
     */
    public function setFound(string $found)
    {
        $this->found = $found;
    }

    /**
     * @return string|null
     */
    public function getResults(): ? string
    {
        return $this->results;
    }

    /**
     * @param string $results
     */
    public function setResults(string $results)
    {
        $this->results = $results;
    }

    /**
     * @return string|null
     */
    public function getSkip(): ? string
    {
        return $this->skip;
    }

    /**
     * @param string $skip
     */
    public function setSkip(string $skip)
    {
        $this->skip = $skip;
    }
}