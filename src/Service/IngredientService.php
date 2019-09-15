<?php
namespace App\Service;

class IngredientService
{
    /**
     * Returns an array of ingredients that are before their best before date
     *@param ingredients The list of ingredients
     * @return the ingredients that are before their best before dates;
     */
    public function filterIsBestBefore($ingredients)
    {
        $result = [];

        foreach ($ingredients as $ingredient) {
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
    public function filterIsAfterBestBeforeAndBeforeUseBy($ingredients)
    {
        return $ingredients;
    }
}
