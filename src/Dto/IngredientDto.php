<?php

namespace App\Dto;

class IngredientDto
{
    private $title;

    private $bestBefore;

    private $useBy;

    /**
     * IngredientDto constructor.
     * @param $title
     * @param $bestBefore
     * @param $useBy
     */
    public function __construct($title, $bestBefore, $useBy)
    {
        $this->title = $title;
        $this->bestBefore = $bestBefore;
        $this->useBy = $useBy;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    /**
     * @return mixed
     */
    public function getUseBy()
    {
        return $this->useBy;
    }
}
