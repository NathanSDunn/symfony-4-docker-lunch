<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController
{
    /**
     * This controller exists purely to disable the / endpoint which would ordinarily show the Symfony 4 splash page
     */
    public function get()
    {
        throw new NotFoundHttpException();
    }
}
