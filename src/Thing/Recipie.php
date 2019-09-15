<?php

namespace App\Thing;

class Recipie
{
    private $title;

    private $ingredients;

    /**
     * Recipie constructor.
     * @param $title
     * @param $ingredients
     */
    public function __construct($title, $ingredients)
    {
        $this->title = $title;
        $this->ingredients = $ingredients;
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
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Determines if a recipie can be fulfilled from a list of ingredients
     * @param $ingredientNames the ingredients available
     * @return bool whether or not all ingredients are available for the recipie
     */
    public function hasAllIngredientNames($ingredientNames)
    {
        $intersect = array_intersect($ingredientNames, $this->getIngredients());

        return count($intersect) == count($this->getIngredients());
    }
}
