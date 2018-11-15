<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function getCurrentAction()
    {
//        $route = new Router();
//        $route1 = $route->currentRouteAction();
        // $uri=$request->path();
        // $url1 = $request->fullUrl();
        $cars= array("Volvo","BMW","Toyota");

        return $cars;

    }

}
