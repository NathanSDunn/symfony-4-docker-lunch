<?php
namespace App\Service;

class RecipieService
{
    protected $recipies;
    protected $ingredientsBestBefore;
    protected $ingredientNamesBeforeUseBy;

    /**
     * RecipieService constructor.
     * @param $recipies
     * @param $ingredientsBestBefore
     * @param $ingredientNamesBeforeUseBy
     */
    public function __construct($recipies, $ingredientsBestBefore, $ingredientNamesBeforeUseBy)
    {
        $this->recipies = $recipies;
        $this->ingredientsBestBefore = $ingredientsBestBefore;
        $this->ingredientNamesBeforeUseBy = $ingredientNamesBeforeUseBy;
    }

    private function filterByIngredients($ingredients)
    {
        $result = [];
        foreach ($this->recipies as $recipie) {
            if ($recipie->hasAllIngredientNames($ingredients)) {
                $result[] = $recipie;
            }
        }

        return $result;
    }

    public function filterBestBefore()
    {
        return $this->filterByIngredients($this->ingredientsBestBefore);
    }

    public function filterBeforeUseBy()
    {
        return $this->filterByIngredients($this->ingredientNamesBeforeUseBy);
    }
}
