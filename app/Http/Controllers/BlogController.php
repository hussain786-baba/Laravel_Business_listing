<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogcategory')->inRandomOrder()->get();

        return view('frontend.blog', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('frontend.blogdetail', compact('blog'));
    }
}
