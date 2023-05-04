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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit user')}}</h1>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.agents.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" placeholder="{{ __('Email') }}" name="email" value="{{ old('email',  $user->email) }}" />
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <input type="text" class="form-control" id="address" placeholder="{{ __('Address') }}" name="address" value="{{ old('address',  $user->address) }}" />
                    </div>
                    <div class="form-group">
                        <label for="city">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="city" placeholder="{{ __('City') }}" name="city" value="{{ old('city',  $user->city) }}" />
                    </div>
                    <div class="form-group">
                        <label for="zip">{{ __('Zip') }}</label>
                        <input type="text" class="form-control" id="zip" placeholder="{{ __('Zip') }}" name="zip" value="{{ old('zip',  $user->zip) }}" />
                    </div>
                    <div class="form-group">
                        <label for="state">{{ __('State') }}</label>
                        <input type="text" class="form-control" id="state" placeholder="{{ __('State') }}" name="state" value="{{ old('state',  $user->state) }}" />
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('Country') }}</label>
                        <input type="text" class="form-control" id="country" placeholder="{{ __('Country') }}" name="country" value="{{ old('country',  $user->country) }}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="number" class="form-control" id="phone" placeholder="{{ __('phone') }}" name="phone" value="{{ old('phone',  $user->phone) }}" />
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">{{ __('Whatsapp') }}</label>
                        <input type="number" class="form-control" id="whatsapp" placeholder="{{ __('whatsapp') }}" name="whatsapp" value="{{ old('whatsapp',  $user->whatsapp) }}" />
                    </div>
                    <div class="form-group">
                        <img width="200" height="200" src="{{ Storage::url($user->profile) }}" class="img-fluid rounded" alt="">
                    </div>
                    <div class="form-group">
                        <label for="profile">{{ __('profile') }}</label>
                        <input type="file" class="form-control" id="profile" placeholder="{{ __('profile') }}" name="profile" value="{{ old('profile',  $user->profile) }}" />
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password', $user->password) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection