<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blog_Category;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogCategoryRequest;
use App\Models\Category_blogs;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Blog_CategoriesController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog_categories = Category_blogs::all();

        return view('admin.blog_categories.index', compact('blog_categories'));
    }

    // public function create(): View
    // {
    //     abort_if(Gate::denies('blog_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
    //     return view('admin.blog_categories.create');
    // }

    // public function store(ValidateBlogCategoryRequest $request): RedirectResponse
    // {
    //     abort_if(Gate::denies('blog_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $slug = Str::slug($request->name, '-');
    //     Blog_Category::create($request->validated() + ['slug' => $slug]);

    //     return redirect()->route('admin.blog_categories.index')->with([
    //         'message' => 'successfully created !',
    //         'alert-type' => 'success'
    //     ]);
    // }

    // public function show(Blog_Category $category): View
    // {
    //     abort_if(Gate::denies('blog_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
    //     return view('admin.blog_categories.show', compact('blog_category'));
    // }

    // public function edit(Blog_Category $category): View
    // {
    //     abort_if(Gate::denies('blog_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
    //     return view('admin.blog_categories.edit', compact('blog_category'));
    // }

    // public function update(ValidateBlogCategoryRequest $request, Blog_Category $category): RedirectResponse
    // {
    //     abort_if(Gate::denies('blog_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
    //     $slug = Str::slug($request->name, '-');
    //     $category->update($request->validated() + ['slug' => $slug]);

    //     return redirect()->route('admin.blog_categories.index')->with([
    //         'message' => 'successfully updated !',
    //         'alert-type' => 'info'
    //     ]);
    // }

    // public function destroy(Blog_Category $category): RedirectResponse
    // {
    //     abort_if(Gate::denies('blog_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $category->delete();

    //     return back()->with([
    //         'message' => 'successfully deleted !',
    //         'alert-type' => 'danger'
    //     ]);
    // }
}
