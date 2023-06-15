<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bloggallery;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBloggalleryRequest;
use Illuminate\Http\Request;
class BloggalleryController extends Controller
{
    public function store(ValidateBloggalleryRequest $request, Blog $blog): RedirectResponse
    {
        if($request->validated()){
            $path = $request->file('path')->store('blogs/bloggallery', 'public');
            $blog->galleries()->create(['path' => $path]);
        }

        return redirect()->route('admin.blogs.edit', $blog->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Blog $blog,Bloggallery $bloggallery): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blog->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.bloggalleries.edit', compact('bloggallery', 'blog'));
    }

    public function update(ValidateBloggalleryRequest $request,Blog $blog, Bloggallery $bloggallery): RedirectResponse
    {
        if($request->validated()){
            File::delete('storage/' . $bloggallery->path);
            $path = $request->file('path')->store('blogs/gallery', 'public');
            $blog->galleries()->update(['path' => $path]);
        }

        return redirect()->route('admin.blogs.edit', $blog->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Blog $blog,Bloggallery $bloggallery): RedirectResponse
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blog->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        if($bloggallery->path){
            File::delete('storage/' . $bloggallery->path);
        }
        $bloggallery->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
