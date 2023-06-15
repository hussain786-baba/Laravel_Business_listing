@extends('layouts.frontend')

@section('content')

<main class="mt-5">
      <section class="container detail-properties">
        <div class="text-center mb-4">
          <h2>{{ $blog->title }}</h2>
          <i class="uil uil-map-marker text-secondary"></i
          ><span>{{ $blog->author }}</span>
        </div>
        <div class="row mb-4">
          <div class="col-lg-6 mb-4">
            <img
              height="460"
              style="object-fit: cover"
              class="rounded w-100"
              src="{{ Storage::url($blog->galleries()->latest()->first()->path) }}"
              alt=""
            />
          </div>
          <div class="col-lg-6">
            <div class="row">
                @foreach($blog->galleries->take(4) as $gallery)
                    <div class="col-lg-6 mb-4">
                        <img
                        style="object-fit: cover"
                        class="img-fluid h-100 w-100 rounded"
                        src="{{ Storage::url($gallery->path) }}"
                        alt=""
                        />
                    </div>
                @endforeach
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 mb-4">
            <div class="card border-0 p-4">
              <div class="d-flex justify-content-between mb-4">
                {{-- <h1>${{ $property->price}}</h1> --}}
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
                      <span class="fw-bold text-secondary">{{ $property->bath }}</span>
                    </div>
                  </div>
                </div> --}}
              </div>
              <h3 class="mb-2">Description</h3>
              <p class="mb-5 text-secondary">
                {{ $blog->description }}
              </p>
              <h4 class="mb-2">Business Features</h4>
              <div class="d-grid grid-custom">
                  @foreach($blog->features as $feature)
                        <div class="col w-100">
                        <div
                            class="d-flex align-items-center"
                            style="column-gap: 0.4rem"
                        >
                            <i class="uil uil-check fs-2 fw-bold text-secondary"></i>
                            <span class="fw-bold text-secondary">{{ $feature->name }}</span>
                        </div>
                        </div>
                    @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card py-5 h-100 border-0">
              <div class="mx-auto text-center">
                <img
                  width="110"
                  height="110"
                  style="object-fit: cover"
                  src="{{ storage::url($blog->agent->profile) }}"
                  class="mb-3 rounded-circle d-block mx-auto border border-warning"
                  alt=""
                />
                <span class="mb-1 d-block text-secondary">Listed By</span>
                <h5 class="mb-3">{{ $blog->agent->name }}</h5>
                <hr />
                {{-- <ul class="list-unstyled mb-5">
                  <li
                    style="column-gap: 3rem"
                    class="text-secondary mb-3 d-flex justify-content-between"
                  >
                    <span class="fw-light">Mobile : </span> {{ $add->agent->phone }}
                  </li>
                  
                  <li
                    style="column-gap: 3rem"
                    class="text-secondary mb-3 d-flex justify-content-between"
                  >
                    <span class="fw-light">WhatsApp : </span> {{ $add->agent->whatsapp }}
                  </li>
                  <li
                    style="column-gap: 3rem"
                    class="text-secondary mb-3 d-flex justify-content-between"
                  >
                    <span class="fw-light">Location: </span> {{ $add->agent->address}}
                  </li>
                  <li
                    style="column-gap: 3rem"
                    class="text-secondary mb-3 d-flex justify-content-between"
                  >
                    <span class="fw-light">Email : </span> {{ $add->agent->email }}
                  </li>
                  
                </ul> --}}
              </div>
             
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection