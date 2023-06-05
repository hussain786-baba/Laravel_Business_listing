<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateAddcategoryRequest;
use App\Models\Addcategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;


class AddcategoryController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('addcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $addcategories = Addcategory::all();

        return view('admin.addcategories.index', compact('addcategories'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('addcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.addcategories.create');
    }

    public function store(ValidateAddcategoryRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('addcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->name, '-');
        Addcategory::create($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.addcategories.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Addcategory $addcategory): View
    {
        abort_if(Gate::denies('addcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.addcategories.show', compact('addcategory'));
    }

    public function edit(Addcategory $addcategory): View
    {
        abort_if(Gate::denies('addcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.addcategories.edit', compact('addcategory'));
    }

    public function update(ValidateAddcategoryRequest $request, Addcategory $addcategory): RedirectResponse
    {
        abort_if(Gate::denies('addcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->name, '-');
        $addcategory->update($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.addcategories.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Addcategory $addcategory): RedirectResponse
    {
        abort_if(Gate::denies('addcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $addcategory->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
