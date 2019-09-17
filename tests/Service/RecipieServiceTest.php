<?php
namespace App\Tests\Service;

use App\Service;
use App\Tests\Mocks\IngredientsMock;
use App\Tests\Mocks\RecipesMock;
use PHPUnit\Framework\TestCase;

class RecipieServiceTest extends TestCase
{
    protected $recipeService;

    protected function setUp()
    {
        $this->recipeService = new Service\RecipeService(
            new RecipesMock(),
            new Service\IngredientService(
                new IngredientsMock()
            )
        );
    }

    public function testFilterBestBefore()
    {
        $result = $this->recipeService->filterBestBefore();
        $this->assertEquals(1, count($result));
        $this->assertEquals('titleBestBefore', $result[0]->getTitle());
    }

    public function testFilterBeforeUseBy()
    {
        $result = $this->recipeService->filterBeforeUseBy();
        $this->assertEquals(2, count($result));
        $this->assertEquals('titleNotExpired', $result[0]->getTitle());
        $this->assertEquals('titleBestBefore', $result[1]->getTitle());
    }

    public function testGetLunch()
    {
        $result = $this->recipeService->getLunch();
        $this->assertEquals(2, count($result));
        $this->assertEquals('titleNotExpired', $result[1]['title']);
        $this->assertEquals('titleBestBefore', $result[0]['title']);
    }
}
