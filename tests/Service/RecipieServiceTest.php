<?php
namespace App\Tests\Service;

use App\Thing;
use App\Service;
use PHPUnit\Framework\TestCase;

class RecipieServiceTest extends TestCase
{
    protected $titleNotExpired = 'Pizza - Not Expired'; //more ingredients probably required in the real world ;)
    protected $ingredientNamesNotExpired = ['Ham', 'Cheese'];
    protected $recipieNotExpired;

    protected $titleBestBefore = 'Ham Snack - Best Before';
    protected $ingredientNamesBestBefore = ['Ham'];
    protected $recipieBestBefore;

    protected $titleExpired = 'Ham & Tomato Melt - Expired';
    protected $ingredientNamesExpired = ['Ham', 'Cheese', 'Tomato'];
    protected $recipieExpired;

    protected $recipies;
    protected $recipeService;

    protected function setUp()
    {
        $this->recipieNotExpired = new Thing\Recipie($this->titleNotExpired, $this->ingredientNamesNotExpired);
        $this->recipieBestBefore = new Thing\Recipie($this->titleBestBefore, $this->ingredientNamesBestBefore);
        $this->recipieExpired = new Thing\Recipie($this->titleExpired, $this->ingredientNamesExpired);

        $this->recipies = [
            $this->recipieNotExpired,
            $this->recipieBestBefore,
            $this->recipieExpired,
        ];

        $this->recipeService = new Service\RecipieService(
            $this->recipies,
            $this->ingredientNamesBestBefore,
            $this->ingredientNamesNotExpired
        );
    }

    public function testFilterBestBefore()
    {
        $result = $this->recipeService->filterBestBefore();
        $this->assertEquals(1, count($result));
    }
}
