<?php
namespace App\Tests\Service;

use App\Thing;
use App\Service\IngredientService;
use PHPUnit\Framework\TestCase;

class IngredientServiceTest extends TestCase
{
    protected $titleBestBefore = 'Ham';
    protected $titleBestAfter = 'Cheese';
    protected $titleExpired = 'Tomato';
    protected $tomorrow;
    protected $today;

    protected $ingredients;

    protected $ingredientService;

    protected function setUp()
    {
        $this->tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->today = date('Y-m-d', strtotime('now'));

        $this->ingredients = [
            $ingredient = new Thing\Ingredient($this->titleBestBefore, $this->tomorrow, $this->tomorrow),
            $ingredient = new Thing\Ingredient($this->titleBestAfter, $this->today, $this->tomorrow),
            $ingredient = new Thing\Ingredient($this->titleExpired, $this->today, $this->today),
        ];

        $this->ingredientService = new IngredientService($this->ingredients);
    }

    public function testFilterIsBestBefore()
    {
        $results = $this->ingredientService->filterIsBestBefore();
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestBefore, $results[0]->getTitle());
    }

    public function testFilterIsAfterBestBeforeAndBeforeUseBy()
    {
        $results = $this->ingredientService->filterIsAfterBestBeforeAndBeforeUseBy();
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestAfter, $results[0]->getTitle());
    }

    public function testGetNamesBestBefore()
    {
        $results = $this->ingredientService->getTitlesBestBefore();
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestBefore, $results[0]);
    }

    public function testGetTitlesBeforeUseBy()
    {
        $results = $this->ingredientService->getTitlesBeforeUseBy();
        $this->assertEquals(count($results), 2);
        $this->assertEquals($this->titleBestBefore, $results[0]);
        $this->assertEquals($this->titleBestAfter, $results[1]);
    }
}
