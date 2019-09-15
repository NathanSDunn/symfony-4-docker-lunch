<?php

namespace App\Thing;

class Ingredient
{
    private $title;

    private $bestBefore;

    private $useBy;

    /**
     * IngredientDto constructor.
     * @param $title
     * @param $bestBefore
     * @param $useBy
     */
    public function __construct($title, $bestBefore, $useBy)
    {
        $this->title = $title;
        $this->bestBefore = $bestBefore;
        $this->useBy = $useBy;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    /**
     * @return mixed
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
    public function isExpired()
    {
        $date = strtotime($this->getUseBy());
        $now = strtotime('now');

        return $now < $date;
    }
}
