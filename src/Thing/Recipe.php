<?php

namespace App\Thing;

class Recipe
{
    private $title;

    private $ingredients;

    private $ingredientsCount;

    /**
     * Recipie constructor.
     * @param $title
     * @param $ingredients
     */
    public function __construct($title, $ingredients)
    {
        $this->title = $title;
        $this->ingredients = $ingredients;
        $this->ingredientsCount = count($ingredients);
    }

    /**
     * Returns the Title of the Recipe
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the Ingredients needed to make the Recipe
     * @return array
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Determines if a recipie can be fulfilled from a list of ingredients
     * @param $ingredientNames array the ingredients available
     * @return bool whether or not all ingredients are available for the recipie
     */
    public function hasAllIngredientNames(array $ingredientNames)
    {
        $intersect = array_intersect($ingredientNames, $this->getIngredients());

        return count($intersect) == $this->ingredientsCount;
    }
}
