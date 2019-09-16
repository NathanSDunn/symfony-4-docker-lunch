<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service;

class LunchController
{
    public function get()
    {
        $data = new Service\DataParser();

        $recipes = $data->readRecipies();
        $ingredients = $data->readIngredients();

        $ingredientService = new Service\IngredientService($ingredients);
        $recipeService = new Service\RecipieService(
            $recipes,
            $ingredientService->getTitlesBestBefore(),
            $ingredientService->getTitlesBeforeUseBy()
        );

        return new Response(json_encode($recipeService->getLunch()));
    }
}
