<?php

namespace App\Service;

use App\Thing;

class Recipes
{
    public function readRecipies($path = 'data/recipies.json')
    {
        $list = json_decode(
            file_get_contents(__DIR__ . '/../../' . $path),
            true
        )['recipes'];

        $recipes = [];

        foreach ($list as $recipe) {
            $recipes[] = new Thing\Recipe($recipe['title'], $recipe['ingredients']);
        }

        return $recipes;
    }
}
