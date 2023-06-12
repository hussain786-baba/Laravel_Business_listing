<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Addcategory;
use Illuminate\Http\Request;

class AddcategoryController extends Controller
{
    public function index(Addcategory $addcategory)
    {
        return view('frontend.addcategory', compact('addcategory'));
    }
}
