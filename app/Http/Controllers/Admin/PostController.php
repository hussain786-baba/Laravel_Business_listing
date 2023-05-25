<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidatePostRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidatePropertyRequest;
use App\Models\Category_blogs;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(auth()->user()->roles()->where('title', 'agent')->count() > 0) {
            $blogpost = Post::where('user_id', auth()->id())->get();
        }else {
            $blogpost = Post::all();
        }

        return view('admin.blogpost.index', compact('blogpost'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $blogpost = Category_blogs::get();

        return view('admin.blogpost.create', compact('blogpost'));
    }

    public function store(ValidatePostRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slug = Str::slug($request->name, '-');
        
        $blogpost = Post::create($request->validated() + ['slug' => $slug, 'user_id' => auth()->id()]);

        return redirect()->route('admin.blogpost.edit', $blogpost->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Post $blogpost): View
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogpost.show', compact('blogpost'));
    }

    public function edit(Post $blogpost): View
    {
         abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         if($blogpost->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         $blog_categories = Category_blogs::get();

        return view('admin.blogpost.edit', compact('blogpost', 'blog_categories'));
    }

    public function update(ValidatePostRequest $request, Post $blogpost): RedirectResponse
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $slug = Str::slug($request->name, '-');

        $blogpost->update($request->validated() + ['slug' => $slug,'user_id' => auth()->id()]);

        return redirect()->route('admin.blogpost.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Post $blogpost): RedirectResponse
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blogpost->agent->name != auth()->user()->name){
            abort(403);
         }

        $blogpost->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
