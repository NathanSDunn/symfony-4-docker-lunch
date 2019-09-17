<?php

namespace App\Service;

use App\Thing;

class Recipes
{
    protected $recipes;

    /**
     * Recipes constructor.
     * This class primarily functions as a Singleton in order to load the recipes.json data only once
     * @param string $path the patch containing the input file relative to repository root
     */
    public function __construct($path = 'data/recipes.json')
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

    /*
     * This function returns an array of recipes as loaded from the source data
     * @return array
     */
    public function get()
    {
        return $this->recipes;
    }
}
