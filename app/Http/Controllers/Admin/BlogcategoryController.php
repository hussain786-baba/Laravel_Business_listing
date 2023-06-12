<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Blogcategory;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogcategoryRequest;
use Illuminate\Http\RedirectResponse;


class BlogcategoryController extends Controller
{
    
    public function index(): View
    {
        abort_if(Gate::denies('blogcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blogcategories = Blogcategory::all();

        return view('admin.blogcategories.index', compact('blogcategories'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('blogcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blogcategories.create');
    }

    public function store(ValidateBlogcategoryRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('blogcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->name, '-');
        Blogcategory::create($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.blogcategories.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Blogcategory $blogcategories): View
    {
        abort_if(Gate::denies('blogcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blogcategories.show', compact('blogcategories'));
    }

    public function edit(Blogcategory $blogcategory): View
    {
        abort_if(Gate::denies('blogcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blogcategories.edit', compact('blogcategory'));
    }

    public function update(ValidateBlogcategoryRequest $request, Blogcategory $blogcategory): RedirectResponse
    {
        abort_if(Gate::denies('blogcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->name, '-');
        $blogcategory->update($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.blogcategories.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Blogcategory $blogcategory): RedirectResponse
    {
        abort_if(Gate::denies('blogcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blogcategory->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
