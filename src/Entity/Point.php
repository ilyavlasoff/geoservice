<?php

namespace App\Entity;

class Point
{
    private $description;
    private $name;
    private $pos;

    /**
     * @return string|null
     */
    public function getDescription(): ? string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getName(): ? string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getPos(): ? string
    {
        return $this->pos;
    }

    /**
     * @param string $pos
     */
    public function setPos(string $pos)
    {
        $this->pos = $pos;
    }

    public function getCoordinates()
    {
        if ($this->pos)
        {
            $coords = explode(' ', $this->pos);
            return [
                'longitude' => floatval($coords[0]),
                'latitude' => floatval($coords[1])
            ];
        }
    }
}