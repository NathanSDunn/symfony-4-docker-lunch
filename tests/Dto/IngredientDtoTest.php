<?php
namespace App\Tests\Dto;

use App\Dto;
use PHPUnit\Framework\TestCase;

class IngredientDtoTest extends TestCase
{
    public function testConstructor()
    {
        $title = 'Ham';
        $bestBefore = '2018-03-25';
        $useBy = '2018-03-27';
        $ingredientDto = new DTO\IngredientDto($title, $bestBefore, $useBy);

        $this->assertEquals($ingredientDto->getTitle(), $title);
        $this->assertEquals($ingredientDto->getBestBefore(), $bestBefore);
        $this->assertEquals($ingredientDto->getUseBy(), $useBy);
    }
}
