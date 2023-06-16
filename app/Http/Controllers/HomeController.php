<?php

namespace App\Http\Controllers;

use App\Models\Add;
use App\Models\Addcategory;
use App\Models\Blog;
use App\Models\Blogcategory;
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
        $blogcategories = Blogcategory::with('blogs')->get();
        $blogs = Blog::with('blogcategory')->inRandomOrder()->get();
        return view('frontend.homepage', compact('categories','adds','addcategories','blogs','blogcategories'));
    }
   
}
