<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Blog_Feature;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateBlogFeatureRequest;


class Blog_FeatureController extends Controller
{
    public function store(ValidateBlogFeatureRequest $request,Post $post ): RedirectResponse
    {
        $post->features()->create($request->validated());

        return redirect()->route('admin.blogpost.edit', $post->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Post $post, Blog_Feature $feature): View
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($post->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.blogfeatures.edit', compact('feature', 'post'));
    }

    public function update(ValidateBlogFeatureRequest $request,Post $post, Blog_Feature $feature): RedirectResponse
    {
        $post->features()->update($request->validated());

        return redirect()->route('admin.blogpost.edit', $post->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Post $post,Blog_Feature $feature): RedirectResponse
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($post->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        $feature->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
