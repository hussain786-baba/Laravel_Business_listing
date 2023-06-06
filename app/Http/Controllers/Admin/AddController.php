<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addcategory;
use App\Models\Add;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateAddRequest;
use App\Models\Post;
use App\Models\User;

class AddController extends Controller
{
    
    public function index(): View
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(auth()->user()->roles()->where('title', 'agent')->count() > 0) {
            $adds = Add::where('user_id', auth()->id())->get();
        }else {
            $adds = Add::all();
        }

        return view('admin.adds.index', compact('adds'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('add_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $addcategories = Addcategory::get();

        return view('admin.adds.create', compact('addcategories'));
    }

    public function store(ValidateAddRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('add_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->name, '-');
        
        $add = Add::create($request->validated() + ['slug' => $slug, 'user_id' => auth()->id()]);

        return redirect()->route('admin.adds.edit', $add->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Add $add): View
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adds.show', compact('add'));
    }

    public function edit(Add $add): View
    {
         abort_if(Gate::denies('add_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         if($add->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         $addcategories = Addcategory::get();
        
        return view('admin.adds.edit', compact('add', 'addcategories'));
    }

    public function update(ValidateAddRequest $request, Add $add): RedirectResponse
    {
        abort_if(Gate::denies('add_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->name, '-');

        $add->update($request->validated() + ['slug' => $slug,'user_id' => auth()->id()]);

        return redirect()->route('admin.adds.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Add $add): RedirectResponse
    {
        abort_if(Gate::denies('add_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($add->agent->name != auth()->user()->name){
            abort(403);
         }

        $add->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
