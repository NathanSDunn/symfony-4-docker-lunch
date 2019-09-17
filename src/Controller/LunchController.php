<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service\RecipeService;

class LunchController
{
    /**
     * This controller manages the /lunch endpoint which will display a JSON formatted list of recipies that contain
     * Ingredients before their use by date. Recipies containing ingredients that are before their use-by date, but
     * after their best-before date will be sorted to the bottom of the list.
     *
     * @param RecipeService $recipeService
     * @return Response a json formatted response with the desired lunch options
     */
    public function get(RecipeService $recipeService)
    {
        return new Response(
            json_encode(
                ['recipes' => $recipeService->getLunch()]
            )
        );
    }
}
