<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Add;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function index()
    {
        $adds = Add::with('category')->inRandomOrder()->get();

        return view('frontend.add', compact('adds'));
    }

    // public function show(Add $add)
    // {
    //     return view('frontend.detail', compact('add'));
    // }
}
