<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Blog_Gallery;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogGalleryRequest;


class Blog_GalleryController extends Controller
{
    public function store(ValidateBlogGalleryRequest $request, Post $post): RedirectResponse
    {
        if($request->validated()){
            $path = $request->file('path')->store('blogpost/bloggallery', 'public');
            $post->galleries()->create(['path' => $path]);
        }

        return redirect()->route('admin.blogpost.edit', $post->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Post $post,Blog_Gallery $bloggallery): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($post->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.bloggalleries.edit', compact('bloggallery', 'post'));
    }

    public function update(ValidateBlogGalleryRequest $request,Post $property, Blog_Gallery $gallery): RedirectResponse
    {
        if($request->validated()){
            File::delete('storage/' . $gallery->path);
            $path = $request->file('path')->store('properties/gallery', 'public');
            $property->galleries()->update(['path' => $path]);
        }

        return redirect()->route('admin.properties.edit', $property->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Post $property,Blog_Gallery $gallery): RedirectResponse
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($property->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        if($gallery->path){
            File::delete('storage/' . $gallery->path);
        }
        $gallery->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
