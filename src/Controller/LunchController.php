<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service;

class LunchController
{
    public function get()
    {
        $recipeService = new Service\RecipeService(
            new Service\Recipes(),
            new Service\IngredientService(
                new Service\Ingredients()
            )
        );

        return new Response(
            json_encode(
                ['recipes' => $recipeService->getLunch()]
            )
        );
    }
}
