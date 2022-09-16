<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingPageController extends Controller
{
    public function index(){

        $items = Product::all();
        return view('layouts.app-landing-page',['items'=>$items]);
    }
}
