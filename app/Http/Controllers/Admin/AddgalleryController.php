<?php

namespace App\Http\Controllers\Admin;
use App\Models\Addgallery;
use App\Models\Add;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateAddgalleryRequest;
use Illuminate\Http\Request;

class AddgalleryController extends Controller
{
    public function store(ValidateAddgalleryRequest $request, Add $add): RedirectResponse
    {
        if($request->validated()){
            $path = $request->file('path')->store('adds/addgallery', 'public');
            $add->galleries()->create(['path' => $path]);
        }

        return redirect()->route('admin.adds.edit', $add->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Add $add,Addgallery $addgallery): View
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($add->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.addgalleries.edit', compact('addgallery', 'add'));
    }

    public function update(ValidateAddgalleryRequest $request,Add $add, Addgallery $addgallery): RedirectResponse
    {
        if($request->validated()){
            File::delete('storage/' . $addgallery->path);
            $path = $request->file('path')->store('adds/gallery', 'public');
            $add->galleries()->update(['path' => $path]);
        }

        return redirect()->route('admin.adds.edit', $add->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Add $add,Addgallery $addgallery): RedirectResponse
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($add->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        if($addgallery->path){
            File::delete('storage/' . $addgallery->path);
        }
        $addgallery->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
