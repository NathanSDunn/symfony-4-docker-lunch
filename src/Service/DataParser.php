<?php

namespace App\Service;

use App\Thing;

class DataParser
{
    public function readRecipies($path = 'data/recipies.json')
    {
        $list = json_decode(
            file_get_contents(__DIR__ . '/../../' . $path),
            true
        )['recipes'];

        $recipes = [];

        foreach ($list as $recipe) {
            $recipes[] = new Thing\Recipie($recipe['title'], $recipe['ingredients']);
        }

        return $recipes;
    }

    public function readIngredients($path = 'data/ingredients.json')
    {
        $list = json_decode(
            file_get_contents(__DIR__ . '/../../' . $path),
            true
        )['ingredients'];

        $ingredients = [];

        foreach ($list as $ingredient) {
            $ingredients[] = new Thing\Ingredient(
                $ingredient['title'],
                $ingredient['best-before'],
                $ingredient['use-by']
            );
        }

        return $ingredients;
    }
}
