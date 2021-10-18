<?php

namespace App\Http\Controllers;

use App\Services\Elastic;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;   
    }

    public function injection()
    {
        return response([
            "message" => $this->elastic->fetchFromElastic()
        ]);
    }

    public function hard()
    {
        $container = new Elastic();

        return response([
            "message" => $container->fetchFromElastic()
        ]);
    }
}