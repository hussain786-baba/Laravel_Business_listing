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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('PRIMARY BLOG DETAILS') }}</h1>
                    <a href="{{ route('admin.blogpost.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogpost.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">{{ __('Blog Post Category') }}</label>
                        <select name="category_blogs_id" class="form-control" id="category">
                            @foreach($blogpost as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('Title') }}" name="name" value="{{ old('name') }}" />
                    </div>           
                    <div class="form-group">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="number" class="form-control" id="price" placeholder="{{ __('price') }}" name="price" value="{{ old('price') }}" />
                    </div>
                    <div class="form-group">
                        <label for="location">{{ __('Location') }}</label>
                        <input type="text" class="form-control" id="location" placeholder="{{ __('location') }}" name="location" value="{{ old('location') }}" />
                    </div>
                    <div class="form-group">
                        <label for="city">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="city" placeholder="{{ __('city') }}" name="city" value="{{ old('city') }}" />
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="number" class="form-control" id="phone" placeholder="{{ __('phone') }}" name="phone" value="{{ old('phone') }}" />
                    </div>
                    <div class="form-group">
                        <label for="website">{{ __('Website') }}</label>
                        <input type="text" class="form-control" id="website" placeholder="{{ __('website') }}" name="website" value="{{ old('website') }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection