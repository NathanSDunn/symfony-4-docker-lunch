<?php
namespace App\Tests\Thing;

use App\Thing;
use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{
    protected $title = 'Ham';
    protected $tomorrow;
    protected $today;

    protected function setUp()
    {
        $this->tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->today = date('Y-m-d', strtotime('now'));
    }

    public function testConstructor()
    {
        $ingredient = new Thing\Ingredient($this->title, $this->today, $this->tomorrow);

        $this->assertEquals($ingredient->getTitle(), $this->title);
        $this->assertEquals($ingredient->getBestBefore(), $this->today);
        $this->assertEquals($ingredient->getUseBy(), $this->tomorrow);
    }

    public function testBestBeforeNotExpired()
    {
        $ingredient = new Thing\Ingredient($this->title, $this->tomorrow, $this->tomorrow);
        $this->assertTrue($ingredient->isBestBefore());
    }

    public function testBestBeforeIsExpired()
    {
        $ingredient = new Thing\Ingredient($this->title, $this->today, $this->tomorrow);
        $this->assertFalse($ingredient->isBestBefore());
    }
    public function testUseByNotExpired()
    {
        $ingredient = new Thing\Ingredient($this->title, $this->tomorrow, $this->tomorrow);
        $this->assertTrue($ingredient->isBeforeUseBy());
    }

    public function testUseByIsExpired()
    {
        $ingredient = new Thing\Ingredient($this->title, $this->today, $this->today);
        $this->assertFalse($ingredient->isBeforeUseBy());
    }
}
