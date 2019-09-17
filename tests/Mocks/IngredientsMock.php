<?php
namespace App\Tests\Mocks;

use App\Service\Ingredients;
use App\Thing;

class IngredientsMock extends Ingredients
{
    protected $tomorrow;
    protected $today;

    protected $ingredients;

    public function __construct()
    {
        $this->tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->today = date('Y-m-d', strtotime('now'));

        $this->ingredients = [
            $ingredient = new Thing\Ingredient('titleBestBefore', $this->tomorrow, $this->tomorrow),
            $ingredient = new Thing\Ingredient('titleBestAfter', $this->today, $this->tomorrow),
            $ingredient = new Thing\Ingredient('titleExpired', $this->today, $this->today),
        ];
    }
}
