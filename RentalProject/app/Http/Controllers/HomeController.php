<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        $cars = Car::latest()->get();
        return view('frontend.homepage', compact('cars'));
    }

    public function detail (Car $car) {
        return view('frontend.detail', compact('car'));
    }
}
