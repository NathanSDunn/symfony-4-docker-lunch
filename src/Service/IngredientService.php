<?php
namespace App\Service;

class IngredientService
{
    protected $ingredients;

    /**
     * IngredientService constructor.
     * @param $ingredients
     */
    public function __construct($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Returns an array of ingredients that are before their best before date
     *@param ingredients The list of ingredients
     * @return the ingredients that are before their best before dates;
     */
    public function filterIsBestBefore()
    {
        $result = [];

        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBestBefore()) {
                $result[] = $ingredient;
            }
        }

        return $result;
    }

    /**
     * Returns an array of ingredients that are after their best-before date, but before their use-by date
     * @param $ingredients the list of ingredients
     * @return the ingredients that are between best-before and use-by dates
     */
    public function filterIsAfterBestBeforeAndBeforeUseBy()
    {
        $result = [];

        foreach ($this->ingredients as $ingredient) {
            if (!$ingredient->isBestBefore() && $ingredient->isBeforeUseBy()) {
                $result[] = $ingredient;
            }
        }

        return $result;
    }

    /**
     * Create an associative array (ie. HashMap) of ingredients that are before their best-before date
     * @param $ingredients the list of ingredients
     * @return the names of ingredients that are before their best before date
     */
    public function getTitlesBestBefore()
    {
        $names = [];

        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBestBefore()) {
                $result[] = $ingredient->getTitle();
            }
        }

        return $result;
    }

    /**
     * Create an associative array (ie. HashMap) of ingredients that are before their use-by date
     * @param $ingredients the list of ingredients
     * @return the names of ingredients that are before their use-by date
     */
    public function getTitlesBeforeUseBy()
    {
        $names = [];

        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->isBeforeUseBy()) {
                $result[] = $ingredient->getTitle();
            }
        }

        return $result;
    }
}
