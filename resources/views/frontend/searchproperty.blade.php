@extends('layouts.frontend')

@section('content')
<main>
      <section
        class="hero-property mb-5"
        style="
          background-image: url('{{ asset('frontend/assets/images/bg-alt.jpg') }}');
          height: 50vh;
        "
      >
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
          </div>
        </div>
      </section>
      <section class="container category" style="margin-bottom: 100px">
        <h3 class="text-center">Search Results   </h3>
        <p class="text-center">make your dream home become reality</p>
        <hr />

        <div class="row mt-5">
        @foreach($searchProperty as $property)
          <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
              <span
                style="border-radius: 0 0.4rem 0 0.4rem"
                class="text-white px-4 py-1 end-0 {{ $property->category->name === 'For Sale' ?  'bg-info' : 'bg-warning' }} position-absolute"
                >{{ $property->category->name }}</span
              >
              <img
                src="{{ Storage::url($property->galleries()->first()->path) }}"
                height="310"
                style="object-fit: cover"
                class="card-img-top"
                alt="{{ $property->name }}"
              />
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
                      <span class="fw-bold text-secondary"> {{ $property->bed }}</span>
                    </div>
                  </div>
                  <div class="col">
                    <small class="text-secondary">Bath</small>
                    <div
                      class="d-flex align-items-center"
                      style="column-gap: 0.4rem"
                    >
                      <i class="uil uil-bath fs-2 fw-bold text-secondary"></i>
                      <span class="fw-bold text-secondary">{{ $property->bath }}</span>
                    </div>
                  </div>
                </div> --}}
                <hr class="mb-5" />
                <h1 style="width: 50%; font-size: 2vw" class="fw-bold mb-0">
                  ${{ $property->price }}
                </h1>
                <a
                  href="{{ route('property.show', $property->slug) }}"
                  style="right: 0; bottom: 0; border-radius: 0.4rem 0 0.4rem 0"
                  class="align-items-center border-0 p-3 px-5 position-absolute btn btn-primary d-inline-flex"
                  >View Detail</a
                >
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </section>
    </main>
@endsection