<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service;

class LunchController
{
    public function get()
    {
        $data = new Service\Recipes();

        $recipes = $data->get();

        $ingredientService = new Service\IngredientService(
            new Service\Ingredients()
        );

        $recipeService = new Service\RecipeService(
            $recipes,
            $ingredientService->getTitlesBestBefore(),
            $ingredientService->getTitlesBeforeUseBy()
        );

        return new Response(
            json_encode(
                ['recipes' => $recipeService->getLunch()]
            )
        );
    }
}
