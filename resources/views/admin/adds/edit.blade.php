@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-3">
                <div class="card shadow mb-2">
                    <div class="card-header py-3 d-flex">
                        <h6 class="m-0 font-weight-bold text-primary">
                        {{ __('list features') }}
                        </h6>
                   </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable datatable-add" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($add->features as $feature)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $feature->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.adds.addfeatures.edit', [$add->id, $feature->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="{{ route('admin.adds.addfeatures.destroy', [$add->id, $feature->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Empty Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ __('add features')}}</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.adds.addfeatures.store', $add->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="card shadow mb-2">
                    <div class="card-header py-3 d-flex">
                        <h6 class="m-0 font-weight-bold text-primary">
                        {{ __('list images') }}
                        </h6>
                   </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable datatable-add" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($add->galleries as $gallery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a target="_blank" href="{{ Storage::url($gallery->path) }}">
                                                <img width="80" height="80" src="{{ Storage::url($gallery->path) }}" alt="{{ $add->name }}">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.adds.addgalleries.edit', [$add->id, $gallery->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="{{ route('admin.adds.addgalleries.destroy', [$add->id, $gallery->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">Data Empty</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ __('add images')}}</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.adds.addgalleries.store', $add->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="path">{{ __('Featured Image') }}</label>
                                <input type="file" class="form-control" id="path" name="path" value="{{ old('path') }}" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit data')}}</h1>
                    <a href="{{ route('admin.adds.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.adds.update', $add->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="addcategory">{{ __('Addcategory') }}</label>
                        <select name="addcategory_id" class="form-control" id="addcategory">
                            @foreach($addcategories as $addcategory)
                            {{-- <option {{ $addcategory->id == $add->addcategory->id ? 'selected' : null }} value="{{ $addcategory->id }}">{{ $addcategory->name}}</option> --}}
                            <option value="{{ $addcategory->id }}">{{ $addcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $add->name ) }}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="location">{{ __('Location') }}</label>
                        <input type="text" class="form-control" id="location" placeholder="{{ __('location') }}" name="location" value="{{ old('location', $add->location ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="city">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="city" placeholder="{{ __('city') }}" name="city" value="{{ old('city', $add->city ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="number" class="form-control" id="phone" placeholder="{{ __('phone') }}" name="phone" value="{{ old('phone', $add->phone ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="website">{{ __('Website') }}</label>
                        <input type="text" class="form-control" id="website" placeholder="{{ __('website') }}" name="website" value="{{ old('website', $add->website) }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Description">{{ old('description', $add->description ) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection

