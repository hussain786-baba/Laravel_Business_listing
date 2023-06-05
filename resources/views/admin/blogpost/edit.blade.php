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
        
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit data')}}</h1>
                    <a href="{{ route('admin.blogpost.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogpost.update', $post->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select name="category_id" class="form-control" id="category">
                            @foreach($category_blogs as $category)
                            <option {{ $category->id == $post->category_blogs->id ? 'selected' : null }} value=""></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" placeholder="{{ __('Title') }}" name="title" value="{{ old('title', $post->title) }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Description">{{ old('description', $post->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="author">{{ __('Author') }}</label>
                        <input type="text" class="form-control" id="author" placeholder="{{ __('Author') }}" name="author" value="{{ old('author', $post->author) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection