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

    public function create(): View
    {
        abort_if(Gate::denies('blog_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blog_categories.create');
    }

    public function store(ValidateBlogCategoryRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('blog_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->name, '-');
        Category_blogs::create($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.blog_categories.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Category_blogs $blog_categories): View
    {
        abort_if(Gate::denies('blog_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blog_categories.show', compact('category'));
    }

    public function edit(Category_blogs $blog_category): View
    {
        abort_if(Gate::denies('blog_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.blog_categories.edit', compact('blog_category'));
    }

    public function update(ValidateBlogCategoryRequest $request, Category_blogs $blog_category): RedirectResponse
    {
        abort_if(Gate::denies('blog_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->name, '-');
        $blog_category->update($request->validated() + ['slug' => $slug]);

        return redirect()->route('admin.blog_categories.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Category_blogs $blog_category): RedirectResponse
    {
        abort_if(Gate::denies('blog_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog_category->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
