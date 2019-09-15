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

    public function filterBestBefore()
    {
        $result = [];
        foreach ($this->recipies as $recipie) {
            if ($recipie->hasAllIngredientNames($this->ingredientsBestBefore)) {
                $result[] = $recipie;
            }
        }

        return $result;
    }
}
