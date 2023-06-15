<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogfeature;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogfeatureRequest;


class BlogfeatureController extends Controller
{
    public function store(ValidateBlogfeatureRequest $request,Blog $blog ): RedirectResponse
    {
        $blog->features()->create($request->validated());

        return redirect()->route('admin.blogs.edit', $blog->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(blog $blog, Blogfeature $blogfeature): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blog->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.blogfeatures.edit', compact('blogfeature', 'blog'));
    }

    public function update(ValidateBlogfeatureRequest $request,Blog $blog, Blogfeature $blogfeature): RedirectResponse
    {
        $blog->features()->update($request->validated());

        return redirect()->route('admin.blogs.edit', $blog->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Blog $blog,Blogfeature $blogfeature): RedirectResponse
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($blog->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        $blogfeature->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
