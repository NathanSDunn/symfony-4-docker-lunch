<?php
namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController
{
    public function get()
    {
        throw new NotFoundHttpException();
    }
}