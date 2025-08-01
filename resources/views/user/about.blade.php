      @extends('layouts.user.main')

      @section('title', 'About Us - Fortu Digital Teknologi')
      <!-- Hero Section -->
      @push('cssOnPage')
          <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
          <style>
              .hero-bg {
                  background-image: url('{{ $hero ? asset('public/storage/' . $hero?->image_1) : 'https://placehold.co/1200x600/94a3b8/080808?text=Hero' }}');
                  background-size: cover;
                  background-position: center;
                  position: relative;
                  z-index: 0;
              }
              
              .hero-bg::before {
                  content: '';
                  position: absolute;
                  inset: 0;
                  background-color: rgba(44, 44, 44, 0.7); /* Adjust opacity as needed */
                  z-index: -1;
              }
          </style>
      @endpush
      @section('content')
          <section class="bg-gray-900 hero-bg text-white relative">
              <div class="container mx-auto px-4 py-20 flex flex-col md:flex-row items-center">
                  <!-- Text Content -->
                  
                  <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
                      <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $hero?->title }}</h1>
                      <div class="text-lg text-white max-w-lg">
                          {!! $hero?->text !!}
                      </div>
                  </div>
                  <!-- Image Content -->
                  <div class="md:w-1/2 flex justify-center">
                      <img src="{{ $hero ? asset('public/storage/' . $hero->image_2) : 'https://placehold.co/1200x600/C7D7D7/080808?text=Isometric' }}" alt="Isometric" class="w-full max-w-md">
                  </div>
              </div>
          </section>

          <!-- About Us Content Section -->
          <section class="py-16 lg:py-24">
              <div class="container mx-auto px-4 max-w-4xl">
                  <div class="ql-snow">
                      <div class="ql-editor">
                          {!! $about?->text !!}
                      </div>
                  </div>
              </div>
          </section>
      @endsection
