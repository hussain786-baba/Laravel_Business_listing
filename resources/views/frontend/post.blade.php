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
          <div class="row text-center" style="padding-top: 120px">
            <h3 class="text-white">Blog List </h3>
          </div>
        </div>
      </section>
      <section class="container category" style="margin-bottom: 100px">
        <h3 class="text-center">Choose Business That You Like</h3>
        <p class="text-center">make your dream home become reality</p>
        <hr />

        {{-- <div class="row mt-5">
        @foreach($posts as $post)
          <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
              <span
                style="border-radius: 0 0.4rem 0 0.4rem"
                class="text-white px-4 py-1 end-0 {{ $post->category_blogs->name === 'Latest' ?  'bg-info' : 'bg-warning' }} position-absolute"
                >{{ $post->category->name }}</span
              >
              <img
                src="{{ Storage::url($post->galleries()->first()->path) }}"
                height="310"
                style="object-fit: cover"
                class="card-img-top"
                alt="{{ $post->title }}"
              />
              <div class="card-body">
                <h5 class="card-title">
                  {{ $post->title }}
                </h5>
                <i class="uil uil-map-marker text-secondary"></i>
                <span class="text-secondary">{{ $post->author ??  }}</span>
                <hr />
                <div class="d-grid grid-custom">
                  <div class="col">
                    <small class="text-secondary">Land Size</small>
                    <div
                      class="d-flex align-items-center"
                      style="column-gap: 0.4rem"
                    >
                      <i
                        class="uil uil-image-resize-square fw-bold fs-2 text-secondary"
                      ></i>
                      <span class="fw-bold text-secondary">{{ $post->size }} sqft </span>
                    </div>
                  </div>
                  <div class="col">
                    <small class="text-secondary">Beds</small>
                    <div
                      class="d-flex align-items-center"
                      style="column-gap: 0.4rem"
                    >
                      <i class="uil uil-bed fs-2 fw-bold text-secondary"></i>
                      <span class="fw-bold text-secondary"> {{ $post->bed }}</span>
                    </div>
                  </div>
                  <div class="col">
                    <small class="text-secondary">Bath</small>
                    <div
                      class="d-flex align-items-center"
                      style="column-gap: 0.4rem"
                    >
                      <i class="uil uil-bath fs-2 fw-bold text-secondary"></i>
                      <span class="fw-bold text-secondary">{{ $post->bath }}</span>
                    </div>
                  </div>
                </div>
                <hr class="mb-5" />
                
                <a
                  href="{{ route('post.show', $post->slug) }}"
                  style="right: 0; bottom: 0; border-radius: 0.4rem 0 0.4rem 0"
                  class="align-items-center border-0 p-3 px-5 position-absolute btn btn-primary d-inline-flex"
                  >View Detail</a
                >
              </div>
            </div>
          </div>
        @endforeach
        </div> --}}
      </section>
    </main>
@endsection