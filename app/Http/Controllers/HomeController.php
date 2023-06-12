<?php

namespace App\Http\Controllers;

use App\Models\Add;
use App\Models\Addcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('properties')->get();
        $adds = Add::with('addcategory')->inRandomOrder()->get();
        $addcategories = Addcategory::with('adds')->get();
        return view('frontend.homepage', compact('categories','adds','addcategories'));
    }
   
}
