<?php

namespace App\Service;

use App\Thing;

class Ingredients
{
    protected $ingredients;

    /**
     * Ingredients constructor.
     * @param string $path the patch containing the input file relative to repository root
     */
    public function __construct($path = 'data/ingredients.json')
    {
        $list = json_decode(
            file_get_contents(__DIR__ . '/../' . $path),
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
        $this->ingredients = $ingredients;
    }

    public function get()
    {
        return $this->ingredients;
    }
}
