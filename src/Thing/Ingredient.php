<?php

namespace App\Thing;

class Ingredient
{
    private $title;

    private $bestBefore;

    private $useBy;

    /**
     * Ingredient constructor.
     * @param $title
     * @param $bestBefore
     * @param $useBy
     */
    public function __construct(string $title, string $bestBefore, string $useBy)
    {
        $this->title = $title;
        $this->bestBefore = $bestBefore;
        $this->useBy = $useBy;
    }

    /**
     * Returns the Title of an Ingredient
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the bestBefore date string of an Ingredient
     * @return string
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    /**
     * Returns the useBy date string of an Ingredient
     * @return string
     */
    public function getUseBy()
    {
        return $this->useBy;
    }

    /**
     * Determines whether or not todays date is before the bestBefore date of the ingredient
     * @return bool if the ingredient is before it's best before date
     */
    public function isBestBefore()
    {
        $date = strtotime($this->getBestBefore());
        $now = strtotime('now');

        return $now < $date;
    }

    /**
     * Determines whether or not todays date is before the useBy date of the ingredient
     * @return bool if the ingredient is expired
     */
    public function isBeforeUseBy()
    {
        $date = strtotime($this->getUseBy());
        $now = strtotime('now');

        return $now < $date;
    }
}
