@extends('layouts.frontend')

@section('content')
    <main>
        <section class="hero" style="background-image: url('{{ asset('frontend/assets/images/bg.jpg') }}')">
            <div class="container">
                <div class="row text-center" style="padding-top: 270px; justify-content: center;">
                    <div class="col-md-5 my-auto" style="position: absolute; z-index:9 ">
                        <form action="{{ url('search') }}" method="GET" role="search"
                            style="margin-top: -200px !important; ">
                            <div class="inpul-group" style="display: inline-flex">
                                <input name="search" value="" type="search" placeholder="search hare"
                                    class="form-control" />
                                <button class="btn bg-white" type="submit" style="margin-left:4px">
                                    <i class="uil uil-search text-primary"></i>
                                </button>
                            </div>
                        </form>
                    </div>



                    <h3 class="text-white">
                        <span class="fw-bold">Find</span> Your Next <br />
                        Dream <span class="fw-bold">Home</span>
                    </h3>
                </div>
            </div>
        </section>
        <section class="container stats" style="margin-bottom: 100px; margin-top: -40px">
            <div class="row justify-content-center">
                <div class="card col-lg-8 p-4 border-0 shadow">
                    <div class="row text-center">
                        <div class="col">
                            <span class="fw-bold fs-1">350+</span> <br />
                            <span class="text-secondary"> Properties Sold</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold fs-1">123+</span> <br />
                            <span class="text-secondary">Happy Client</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold fs-1">100+</span> <br />
                            <span class="text-secondary">Agents</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold fs-1">1000+</span> <br />
                            <span class="text-secondary">Properties</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($categories as $category)
            <section class="container category" style="margin-bottom: 100px">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $category->name }}</h3>
                    <a href="{{ route('category.index', $category->slug) }}" style="height: 50px"
                        class="d-flex px-5 align-items-center btn btn-outline-dark">See More</a>
                </div>
                <hr />

                <div class="row">
                    @foreach ($category->properties as $property)
                        <div class="col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm">
                                <img height="310" style="object-fit: cover"
                                    src="{{ Storage::url($property->galleries()->first()->path) }}" class="card-img-top"
                                    alt="{{ $property->galleries()->first()->path }}" />
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $property->name }}
                                    </h5>
                                    <i class="uil uil-map-marker text-secondary"></i>
                                    <span class="text-secondary">{{ $property->location }}</span>
                                    <hr />
                                    {{-- <div class="d-grid grid-custom">
                      <div class="col">
                        <small class="text-secondary">Land Size</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i
                            class="uil uil-image-resize-square fw-bold fs-2 text-secondary"
                          ></i>
                          <span class="fw-bold text-secondary">{{ $property->size }} sqft </span>
                        </div>
                      </div>
                      <div class="col">
                        <small class="text-secondary">Beds</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i class="uil uil-bed fs-2 fw-bold text-secondary"></i>
                          <span class="fw-bold text-secondary">{{ $property->bed }}</span>
                        </div>
                      </div>
                      <div class="col">
                        <small class="text-secondary">Bath</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i class="uil uil-bath fs-2 fw-bold text-secondary"></i>
                          <span class="fw-bold text-secondary"> {{ $property->bath }} </span>
                        </div>
                      </div>
                    </div> --}}
                                    <hr class="mb-5" />
                                    {{-- <h1 style="width: 50%; font-size: 2vw" class="fw-bold mb-0">
                                        ${{ $property->price }}
                                    </h1> --}}
                                    <a href="{{ route('property.show', $property->slug) }}"
                                        style="right: 0; bottom: 0; border-radius: 0.4rem 0 0.4rem 0"
                                        class="align-items-center border-0 p-3 px-5 position-absolute btn btn-primary d-inline-flex">View
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        {{-- for add  --}}

        @foreach ($addcategories as $category)
            <section class="container category" style="margin-bottom: 100px">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $category->name }}</h3>
                    <a href="{{ route('addcategory.index', $category->slug) }}" style="height: 50px"
                        class="d-flex px-5 align-items-center btn btn-outline-dark">See More</a>
                </div>
                <hr />

                <div class="row">
                    @foreach ($category->adds as $add)
                        <div class="col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm">
                                <img height="310" style="object-fit: cover"
                                    src="{{ Storage::url($add->galleries()->first()->path) }}" class="card-img-top"
                                    alt="{{ $add->galleries()->first()->path }}" />
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $add->name }}
                                    </h5>
                                    <i class="uil uil-map-marker text-secondary"></i>
                                    <span class="text-secondary">{{ $add->location }}</span>
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
                                                <span class="fw-bold text-secondary"> {{ $add->bath }} </span>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <hr class="mb-5" />
                                    {{-- <h1 style="width: 50%; font-size: 2vw" class="fw-bold mb-0">
                                        ${{ $add->price }}
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
        @endforeach
        {{-- for add  --}}
        {{-- for blog start  --}}
        @foreach ($blogcategories as $category)
            <section class="container category" style="margin-bottom: 100px">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $category->name }}</h3>
                    <a href="{{ route('addcategory.index', $category->slug) }}" style="height: 50px"
                        class="d-flex px-5 align-items-center btn btn-outline-dark">See More</a>
                </div>
                <hr />
                <div class="row mt-5">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm">
                                <span style="border-radius: 0 0.4rem 0 0.4rem"
                                    class="text-white px-4 py-1 end-0 {{ $blog->name === 'For Sale' ? 'bg-info' : 'bg-warning' }} position-absolute">Blog</span>
                                <img src="{{ Storage::url($blog->galleries()->first()->path) }}" height="310"
                                    style="object-fit: cover" class="card-img-top" alt="{{ $blog->name }}" />
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $blog->title }}
                                    </h5>
                                    <i class="uil uil-user text-secondary"></i>
                                    <span class="text-secondary">{{ $blog->author }}</span>
                                    <hr />
                                    {{-- <div class="d-grid grid-custom">
                      <div class="col">
                        <small class="text-secondary">Land Size</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i
                            class="uil uil-image-resize-square fw-bold fs-2 text-secondary"
                          ></i>
                          <span class="fw-bold text-secondary">{{ $add->size }} sqft </span>
                        </div>
                      </div>
                      <div class="col">
                        <small class="text-secondary">Beds</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i class="uil uil-bed fs-2 fw-bold text-secondary"></i>
                          <span class="fw-bold text-secondary"> {{ $add->bed }}</span>
                        </div>
                      </div>
                      <div class="col">
                        <small class="text-secondary">Bath</small>
                        <div
                          class="d-flex align-items-center"
                          style="column-gap: 0.4rem"
                        >
                          <i class="uil uil-bath fs-2 fw-bold text-secondary"></i>
                          <span class="fw-bold text-secondary">{{ $add->bath }}</span>
                        </div>
                      </div>
                    </div>  --}}
                                    <hr class="mb-5" />
                                    {{-- <h1 style="width: 50%; font-size: 2vw" class="fw-bold mb-0">
                      ${{ $add->price }}
                    </h1>  --}}
                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                        style="right: 0; bottom: 0; border-radius: 0.4rem 0 0.4rem 0"
                                        class="align-items-center border-0 p-3 px-5 position-absolute btn btn-primary d-inline-flex">View
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
        {{-- for blog end  --}}
    </main>
@endsection
