<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blogcategory;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(auth()->user()->roles()->where('title', 'agent')->count() > 0) {
            $blogs = Blog::where('user_id', auth()->id())->get();
        }else {
            $blogs = Blog::all();
        }

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $blogcategories = Blogcategory::get();

        return view('admin.blogs.create', compact('blogcategories'));
    }

    public function store(ValidateBlogRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->title, '-');
        
        $blog = Blog::create($request->validated() + ['slug' => $slug, 'user_id' => auth()->id()]);

        return redirect()->route('admin.blogs.edit', $blog->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Blog $blog): View
    {
        abort_if(Gate::denies('Blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.properties.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
         abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         if($blog->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         $blogcategories = Blogcategory::get();

        return view('admin.blogs.edit', compact('blog', 'blogcategories'));
    }

    public function update(ValidateBlogRequest $request, Blog $blog): RedirectResponse
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->title, '-');

        $blog->update($request->validated() + ['slug' => $slug,'user_id' => auth()->id()]);

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blog->agent->name != auth()->user()->name){
            abort(403);
         }

        $blog->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
