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
     * Returns an array of ingredients that are before their best before date
     *@param ingredients The list of ingredients
     * @return array the ingredients that are before their best before dates;
     */
    public function filterIsBestBefore()
    {
        $result = [];

        /** @var Ingredient $ingredient */
        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBestBefore()) {
                $result[] = $ingredient;
            }
        }

        return $result;
    }

    /**
     * Returns an array of ingredients that are after their best-before date, but before their use-by date
     * @return array the ingredients that are between best-before and use-by dates
     */
    public function filterIsAfterBestBeforeAndBeforeUseBy()
    {
        $result = [];

        /** @var Ingredient $ingredient */
        foreach ($this->ingredients as $ingredient) {
            if (!$ingredient->isBestBefore() && $ingredient->isBeforeUseBy()) {
                $result[] = $ingredient;
            }
        }

        return $result;
    }

    /**
     * Create an associative array (ie. HashMap) of ingredients that are before their best-before date
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
     * Create an associative array (ie. HashMap) of ingredients that are before their use-by date
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
