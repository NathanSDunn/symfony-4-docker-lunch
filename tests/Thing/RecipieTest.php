<?php

namespace App\Tests\Thing;

use App\Thing;
use PHPUnit\Framework\TestCase;

class RecipieTest extends TestCase
{
    protected $title = 'Pizza';
    protected $ingredientNames = ['Ham', 'Cheese'];
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
    }
}
