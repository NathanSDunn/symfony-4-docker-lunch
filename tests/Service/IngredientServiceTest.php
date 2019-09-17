<?php
namespace App\Tests\Service;

use App\Service\IngredientService;
use App\Tests\Mocks\IngredientsMock;
use PHPUnit\Framework\TestCase;

class IngredientServiceTest extends TestCase
{
    protected $ingredientService;

    protected function setUp()
    {
        $this->ingredientService = new IngredientService(
            new IngredientsMock()
        );
    }

    public function testGetNamesBestBefore()
    {
        $results = $this->ingredientService->getTitlesBestBefore();
        $this->assertEquals(1, count($results));
        $this->assertEquals('titleBestBefore', $results[0]);
    }

    public function testGetTitlesBeforeUseBy()
    {
        $results = $this->ingredientService->getTitlesBeforeUseBy();
        $this->assertEquals(2, count($results));
        $this->assertEquals('titleBestBefore', $results[0]);
        $this->assertEquals('titleBestAfter', $results[1]);
    }
}
