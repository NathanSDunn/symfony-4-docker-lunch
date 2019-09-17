<?php
namespace App\Tests\Mocks;

use App\Service\Recipes;
use App\Thing;

class RecipesMock extends Recipes
{
    /*
     * Mock a set of recipies for testing
     * @param
     * @return array
     */
    public function __construct()
    {
        $recipeNotExpired = new Thing\Recipe('titleNotExpired', ['titleBestBefore', 'titleBestAfter']);
        $recipeBestBefore = new Thing\Recipe('titleBestBefore', ['titleBestBefore']);
        $recipeExpired = new Thing\Recipe('titleExpired', ['titleBestBefore', 'titleBestAfter', 'titleExpired']);

        $this->recipes = [
            $recipeNotExpired,
            $recipeBestBefore,
            $recipeExpired,
        ];

        return $this->recipes;
    }
}
