<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class LunchController
{
    public function get()
    {
        $lunch = [];

        return new Response(
            json_encode($lunch)
        );
    }
}
