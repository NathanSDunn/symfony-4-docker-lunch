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
    public function __construct(Recipes $recipes, IngredientService $ingredientService)
    {
        $this->recipes = $recipes->get();
        $this->ingredientsBestBefore = $ingredientService->getTitlesBestBefore();
        $this->ingredientNamesBeforeUseBy = $ingredientService->getTitlesBeforeUseBy();
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
            $result[$recipe->getTitle()] = $recipe;
        }

        foreach ($this->filterBeforeUseBy() as $recipe) {
            $result[$recipe->getTitle()] = $recipe;
        }

        $recipes = [];
        foreach ($result as $key => $value) {
            $recipes[] = [
                'title' => $value->getTitle(),
                'ingredients' => $value->getIngredients(),
            ];
        }

        return $recipes;
    }
}
