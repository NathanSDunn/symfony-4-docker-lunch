<?php
namespace App\Tests\Mocks;

use App\Service\Ingredients;
use App\Thing;

class IngredientsMock extends Ingredients
{
    public function __construct()
    {
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $today = date('Y-m-d', strtotime('now'));

        $this->ingredients = [
            $ingredient = new Thing\Ingredient('titleBestBefore', $tomorrow, $tomorrow),
            $ingredient = new Thing\Ingredient('titleBestAfter', $today, $tomorrow),
            $ingredient = new Thing\Ingredient('titleExpired', $today, $today),
        ];
    }
}
