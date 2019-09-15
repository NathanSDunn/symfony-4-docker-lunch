<?php

namespace App\Thing;

class Recipie
{
    private $title;

    private $ingredients;

    /**
     * Recipie constructor.
     * @param $title
     * @param $ingredients
     */
    public function __construct($title, $ingredients)
    {
        $this->title = $title;
        $this->ingredients = $ingredients;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}
