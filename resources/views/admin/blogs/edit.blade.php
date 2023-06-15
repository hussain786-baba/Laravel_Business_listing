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
                                @forelse($blog->features as $feature)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $feature->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.blogs.blogfeatures.edit', [$blog->id, $feature->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="{{ route('admin.blogs.blogfeatures.destroy', [$blog->id, $feature->id]) }}" method="POST">
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
                            <h1 class="h3 mb-0 text-gray-800">{{ __('blog features')}}</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.blogfeatures.store', $blog->id) }}" method="POST">
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
                                @forelse($blog->galleries as $gallery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a target="_blank" href="{{ Storage::url($gallery->path) }}">
                                                <img width="80" height="80" src="{{ Storage::url($gallery->path) }}" alt="{{ $blog->name }}">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.blogs.bloggalleries.edit', [$blog->id, $gallery->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="{{ route('admin.blogs.bloggalleries.destroy', [$blog->id, $gallery->id]) }}" method="POST">
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
                            <h1 class="h3 mb-0 text-gray-800">{{ __('blog images')}}</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.bloggalleries.store', $blog->id) }}" method="POST" enctype="multipart/form-data">
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
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="blogcategory">{{ __('Blog category') }}</label>
                        <select name="blogcategory_id" class="form-control" id="blogcategory">
                            @foreach($blogcategories as $blogcategory)
                            {{-- <option {{ $blogcategory->id == $blog->blogcategory->id ? 'selected' : null }} value="{{ $blogcategory->id }}">{{ $blogcategory->name}}</option> --}}
                            <option value="{{ $blogcategory->id }}">{{ $blogcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" placeholder="{{ __('Title') }}" name="title" value="{{ old('title', $blog->title ) }}" />
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Description">{{ old('description', $blog->description ) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="author">{{ __('Author') }}</label>
                        <input type="text" class="form-control" id="author" placeholder="{{ __('author') }}" name="author" value="{{ old('author', $blog->author ) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection

