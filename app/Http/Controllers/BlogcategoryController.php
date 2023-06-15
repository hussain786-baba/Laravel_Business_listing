<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class BlogcategoryController extends Controller
{
    
    public function index(Blogcategory $blogcategory)
    {
        return view('frontend.blogcategory', compact('blogcategory'));
    }
}
