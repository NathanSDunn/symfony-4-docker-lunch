<?php
namespace App\Tests\Mocks;

use App\Service\Recipes;
use App\Thing;

class RecipesMock extends Recipes
{
    protected $ingredientNamesBestBefore = ['titleBestBefore'];
    protected $recipieBestBefore;

    protected $ingredientNamesNotExpired = ['titleBestBefore', 'titleBestAfter'];
    protected $recipieNotExpired;

    protected $ingredientNamesExpired = ['titleBestBefore', 'titleBestAfter', 'titleExpired'];
    protected $recipieExpired;

    /*
     * Mock a set of recipies for testing
     * @param
     * @return array
     */
    public function get($path = 'data/recipies.json')
    {
        $this->recipieNotExpired = new Thing\Recipe('titleNotExpired', $this->ingredientNamesNotExpired);
        $this->recipieBestBefore = new Thing\Recipe('titleBestBefore', $this->ingredientNamesBestBefore);
        $this->recipieExpired = new Thing\Recipe('titleExpired', $this->ingredientNamesExpired);

        $this->recipies = [
            $this->recipieNotExpired,
            $this->recipieBestBefore,
            $this->recipieExpired,
        ];

        return $this->recipies;
    }
}
