@extends('layouts.frontend')

@section('content')
    <main>
        <section class="hero-property mb-5"
            style="
          background-image: url('{{ asset('frontend/assets/images/bg-alt.jpg') }}');
          height: 50vh;
        ">
            <div class="container">
                <div class="row text-center" style="padding-top: 120px">
                    <h3 class="text-white">{{ $blogcategory->name }} Adds</h3>
                </div>
            </div>
        </section>
        <section class="container category" style="margin-bottom: 100px">
            <h3 class="text-center">Choose Properties That You Like</h3>
            <p class="text-center">make your dream home become reality</p>
            <hr />

            <div class="row mt-5">
                @foreach ($blogcategory->blogs as $blog)
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ Storage::url($blog->galleries()->first()->path) }}" height="310"
                                style="object-fit: cover" class="card-img-top" alt="{{ $add->name }}" />
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $blog->title }}
                                </h5>
                                <i class="uil uil-map-marker text-secondary"></i>
                                <span class="text-secondary">{{ $blog->location }}</span>
                                <hr />
                                {{-- <div class="d-grid grid-custom">
                                    <div class="col">
                                        <small class="text-secondary">Land Size</small>
                                        <div class="d-flex align-items-center" style="column-gap: 0.4rem">
                                            <i class="uil uil-image-resize-square fw-bold fs-2 text-secondary"></i>
                                            <span class="fw-bold text-secondary">{{ $add->size }} sqft </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <small class="text-secondary">Beds</small>
                                        <div class="d-flex align-items-center" style="column-gap: 0.4rem">
                                            <i class="uil uil-bed fs-2 fw-bold text-secondary"></i>
                                            <span class="fw-bold text-secondary">{{ $add->bed }}</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <small class="text-secondary">Bath</small>
                                        <div class="d-flex align-items-center" style="column-gap: 0.4rem">
                                            <i class="uil uil-bath fs-2 fw-bold text-secondary"></i>
                                            <span class="fw-bold text-secondary">{{ $add->bath }}</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <hr class="mb-5" />
                                {{-- <h1 style="width: 50%; font-size: 2vw" class="fw-bold mb-0">
                  ${{ $property->price }}
                </h1> --}}
                                <a href="{{ route('add.show', $add->slug) }}"
                                    style="right: 0; bottom: 0; border-radius: 0.4rem 0 0.4rem 0"
                                    class="align-items-center border-0 p-3 px-5 position-absolute btn btn-primary d-inline-flex">View
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
