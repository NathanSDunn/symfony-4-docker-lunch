<?php
namespace App\Service;

use App\Thing\Ingredient;

class IngredientService
{
    protected $ingredients;

    /**
     * IngredientService constructor.
     * @param $ingredients
     */
    public function __construct(Ingredients $ingredients)
    {
        $this->ingredients = $ingredients->get();
    }

    /**
     * Create an array of ingredients that are before their best-before date
     * @return array the names of ingredients that are before their best before date
     */
    public function getTitlesBestBefore()
    {
        $result = [];

        /** @var Ingredient $ingredient */
        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBestBefore()) {
                $result[] = $ingredient->getTitle();
            }
        }

        return $result;
    }

    /**
     * Create an array of ingredients that are before their use-by date
     * @return array the names of ingredients that are before their use-by date
     */
    public function getTitlesBeforeUseBy()
    {
        $result = [];

        /** @var Ingredient $ingredient */
        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBeforeUseBy()) {
                $result[] = $ingredient->getTitle();
            }
        }

        return $result;
    }
}
