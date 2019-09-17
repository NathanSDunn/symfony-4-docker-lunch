<?php
namespace App\Service;

use App\Thing\Recipe;

class RecipeService
{
    protected $recipes;
    protected $ingredientsBestBefore;
    protected $ingredientNamesBeforeUseBy;

    /**
     * RecipeService constructor.
     * @param Recipes $recipes
     * @param IngredientService $ingredientService
     */
    public function __construct(Recipes $recipes, IngredientService $ingredientService)
    {
        $this->recipes = $recipes->get();
        $this->ingredientsBestBefore = $ingredientService->getTitlesBestBefore();
        $this->ingredientNamesBeforeUseBy = $ingredientService->getTitlesBeforeUseBy();
    }

    private function filterByIngredients(array $ingredients)
    {
        $result = [];
        /* @var $recipe Recipe */
        foreach ($this->recipes as $recipe) {
            if ($recipe->hasAllIngredientNames($ingredients)) {
                $result[] = $recipe;
            }
        }

        return $result;
    }

    public function filterBestBefore()
    {
        return $this->filterByIngredients((array) $this->ingredientsBestBefore);
    }

    public function filterBeforeUseBy()
    {
        return $this->filterByIngredients((array) $this->ingredientNamesBeforeUseBy);
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
