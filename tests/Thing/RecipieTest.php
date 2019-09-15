<?php

namespace App\Tests\Thing;

use App\Thing;
use PHPUnit\Framework\TestCase;

class RecipieTest extends TestCase
{
    protected $title = 'Pizza';
    protected $ingredientNames = ['Ham', 'Cheese'];
    protected $ingredientNamesMissing = ['Ham'];
    protected $recipie;

    protected function setUp()
    {
        $this->recipie = new Thing\Recipie($this->title, $this->ingredientNames);
    }

    public function testConstructor()
    {
        $this->assertEquals($this->title, $this->recipie->getTitle());
        $names = $this->ingredientNames;
        $this->assertEquals(2, count($names));
        $this->assertEquals(
            $this->ingredientNames[0],
            $this->recipie->getIngredients()[0]
        );
        $this->assertEquals(
            $this->ingredientNames[1],
            $this->recipie->getIngredients()[1]
        );
    }

    public function testHasAllIngredientNames()
    {
        $this->assertTrue($this->recipie->hasAllIngredientNames($this->ingredientNames));
    }

    public function testNotHasAllIngredientNames()
    {
        $this->assertFalse($this->recipie->hasAllIngredientNames($this->ingredientNamesMissing));
    }
}
