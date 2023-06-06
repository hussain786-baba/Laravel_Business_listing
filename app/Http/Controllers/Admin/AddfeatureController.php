<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addfeature;
use App\Models\Add;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ValidateAddfeatureRequest;

class AddfeatureController extends Controller
{
    public function store(ValidateAddfeatureRequest $request,Add $add ): RedirectResponse
    {
        $add->features()->create($request->validated());

        return redirect()->route('admin.adds.edit', $add->id)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Add $add, Addfeature $addfeature): View
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($add->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }
         
        return view('admin.addfeatures.edit', compact('addfeature', 'add'));
    }

    public function update(ValidateAddfeatureRequest $request,Add $add, Addfeature $addfeature): RedirectResponse
    {
        $add->features()->update($request->validated());

        return redirect()->route('admin.adds.edit', $add->id)->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Add $add,Addfeature $addfeature): RedirectResponse
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($add->agent->name != auth()->user()->name && auth()->user()->roles()->where('title', 'agent')->count() > 0){
            abort(403);
         }

        $addfeature->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
