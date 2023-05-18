<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateBlogRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidatePropertyRequest;
use App\Models\Blog;
use App\Models\User;
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
        
        $categories = Category::get();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(ValidateBlogRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tile = Str::title($request->name, '-');
        
        $blogs = Blog::create($request->validated() + ['slug' => $tile, 'user_id' => auth()->id()]);

        return redirect()->route('admin.blogs.edit', $blogs->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Blog $blogs): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.show', compact('blogs'));
    }

    public function edit(Blog $blogs): View
    {
         abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         if($blogs->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         $categories = Category::get();

        return view('admin.blogs.edit', compact('blogs', 'categories'));
    }

    public function update(ValidateBlogRequest $request, Blog $blogs): RedirectResponse
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $title = Str::slug($request->name, '-');

        $blogs->update($request->validated() + ['slug' => $title,'user_id' => auth()->id()]);

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Blog $blogs): RedirectResponse
    {
        // abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // if($blogs->agent->name != auth()->user()->name){
        //     abort(403); 
        //  }
      

        $blogs->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
