<?php

namespace App\Service;

use App\Thing;

class Recipes
{
    protected $recipes;

    /**
     * Recipes constructor.
     * @param string $path the patch containing the input file relative to repository root
     */
    public function __construct($path = 'data/recipies.json')
    {
        $list = json_decode(
            file_get_contents(__DIR__ . '/../' . $path),
            true
        )['recipes'];

        $recipes = [];

        foreach ($list as $recipe) {
            $recipes[] = new Thing\Recipe($recipe['title'], $recipe['ingredients']);
        }

        $this->recipes = $recipes;
    }

    public function get()
    {
        return $this->recipes;
    }
}
