<?php
namespace App\Service;

class RecipeService
{
    protected $recipes;
    protected $ingredientsBestBefore;
    protected $ingredientNamesBeforeUseBy;

    /**
     * RecipeService constructor.
     * @param $recipes
     * @param $ingredientsBestBefore
     * @param $ingredientNamesBeforeUseBy
     */
    public function __construct($recipes, $ingredientsBestBefore, $ingredientNamesBeforeUseBy)
    {
        $this->recipes = $recipes;
        $this->ingredientsBestBefore = $ingredientsBestBefore;
        $this->ingredientNamesBeforeUseBy = $ingredientNamesBeforeUseBy;
    }

    private function filterByIngredients($ingredients)
    {
        $result = [];
        foreach ($this->recipes as $recipe) {
            if ($recipe->hasAllIngredientNames($ingredients)) {
                $result[] = $recipe;
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

    public function getLunch()
    {
        $result = [];
        foreach ($this->filterBestBefore() as $recipe) {
            $name = $recipe->getTitle();
            if (!in_array($name, $result)) {
                $result[] = $name;
            }
        }

        foreach ($this->filterBeforeUseBy() as $recipe) {
            $name = $recipe->getTitle();
            if (!in_array($name, $result)) {
                $result[] = $name;
            }
        }

        return $result;
    }
}
