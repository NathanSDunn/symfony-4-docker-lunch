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

    protected $ingredientsFixture;

    protected function setUp()
    {
        $this->tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->today = date('Y-m-d', strtotime('now'));

        $this->ingredientsFixture = [
            $ingredient = new Thing\Ingredient($this->titleBestBefore, $this->tomorrow, $this->tomorrow),
            $ingredient = new Thing\Ingredient($this->titleBestAfter, $this->today, $this->tomorrow),
            $ingredient = new Thing\Ingredient($this->titleExpired, $this->today, $this->today),
        ];
    }

    public function testFilterIsBestBefore()
    {
        $ingredientService = new IngredientService();
        $results = $ingredientService->filterIsBestBefore($this->ingredientsFixture);
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestBefore, $results[0]->getTitle());
    }

    public function testFilterIsAfterBestBeforeAndBeforeUseBy()
    {
        $ingredientService = new IngredientService();
        $results = $ingredientService->filterIsAfterBestBeforeAndBeforeUseBy($this->ingredientsFixture);
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestAfter, $results[0]->getTitle());
    }

    public function testGetNamesBestBefore()
    {
        $ingredientService = new IngredientService();
        $results = $ingredientService->getTitlesBestBefore($this->ingredientsFixture);
        $this->assertEquals(count($results), 1);
        $this->assertEquals($this->titleBestBefore, $results[0]);
    }
}
