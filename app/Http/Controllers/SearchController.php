<?php

namespace App\Http\Controllers;
use App\Models\Property;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProperty(Request $request){
        if($request->search){
            $searchProperty = property::where('name','LIKE','%'.$request->search.'%')->get();
            // $searchProperty = property::where('location','LIKE','%'.$request->search.'%')->get();
            return view('frontend.searchproperty', compact('searchProperty'));
         

        }
        else{
            return redirect()->back()->with('messege','Empty Search');
        }
    }
}
