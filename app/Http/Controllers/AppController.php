<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AppController extends Controller
{
    public function index()
    {
        $showRoutes = Route::getRoutes();
        $routes = [];

        foreach($showRoutes as $route){
            $routes[$route->getName()] = "/" . $route->uri();
            // $routes[$route->getName()] = str_replace("api", "", $route->uri());;
        }

        return view('app', compact('routes'));
    }
}
