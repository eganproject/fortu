    @extends('layouts.user.main')
    @section('title', 'Blog - Fortu Digital Teknologi')
    @section('content')
        <!-- Featured Post Section -->
        <section class="bg-gradient-to-r from-stone-500 via-stone-600 to-stone-500 text-white">
            <div class="container mx-auto px-4 py-8 md:py-12 text-center">
                <p class="text-sm text-gray-300 mb-2">Artikel Post</p>
                <!-- Ukuran font berbeda untuk mobile (text-2xl) dan desktop (md:text-4xl) -->
                <h1 class="text-2xl md:text-4xl font-bold max-w-2xl mb-6 mx-auto">
                    {{ $hero ? $hero->title : 'Belum ada post' }}</h1>
                <div class="relative rounded-lg overflow-hidden">
                    <img src="{{ $blog[0] ? asset('storage/' . $blog[0]->image) : 'https://placehold.co/1200x500/C7C7C7/FFFFFF?text=IMG+Post' }}"
                        alt="Featured Blog Post" class="w-full h-auto">
                    <!-- Padding dan posisi disesuaikan untuk mobile dan desktop -->
                    <div class="absolute bottom-0 left-0 w-full p-2 md:p-8 text-left">

                        <div class="bg-black bg-opacity-50 backdrop-blur-sm p-3 md:p-4 rounded-lg max-w-full md:max-w-sm">

                            <h2 class="text-sm md:text-xl font-bold mb-1 md:mb-2">
                                {{ Str::limit($blog[0] ? $blog[0]->title : 'Belum ada post', 50) }}</h2>

                            <a href="/blog/{{ $blog[0]?->slug }}"
                                class="text-gray-300 hover:text-white font-semibold text-xs md:text-sm">Read More
                                &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Grid Section -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-lg font-semibold text-gray-500 mb-8">All Posts</h2>
                <div id="blog-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Blog Card Template -->
                    @foreach ($blog as $item)
                        <div class="bg-white rounded-lg border border-gray-200 flex flex-col">
                            <a href="/blog/{{ $item->slug }}" class="block">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/400x250/E9D5FF/3B0764?text=Blog+Post' }}"
                                    alt="Blog post image" class="w-full h-48 object-cover rounded-t-lg">
                            </a>
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center space-x-2">
                                        <img class="w-8 h-8 rounded-full"
                                            src="https://placehold.co/40x40/CFD8DC/78909C?text=A" alt="Author avatar">
                                        <div class="text-xs text-gray-500">
                                            <p class="font-semibold text-gray-800">{{ $item->user->name }}</p>
                                            <p>
                                                @if (Carbon\Carbon::parse($item->tanggal)->isToday())
                                                    {{ Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->diffForHumans() }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->format('d F Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                    </button>
                                </div>
                                <h3 class="font-bold text-lg mb-4 flex-grow">
                                    <a href="/blog/{{ $item?->slug }}" class="hover:text-gray-600">
                                        {{ Str::limit($item->title, 75) }}
                                    </a>
                                </h3>
                                <div
                                    class="border-t border-gray-200 pt-3 flex justify-between items-center text-xs text-gray-500">
                                    <div class="flex space-x-4">
                                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg> {{ $item->views }}</span>
                                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>{{ $item->comments }}</span>

                                        <span class="flex items-center"><svg class="w-4 h-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>{{ $item->likes }}</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="loading-indicator" class="text-center py-8 hidden">
                        <p class="text-gray-500">Memuat lebih banyak post...</p>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @push('jsOnPage')
        <script>
            $(document).ready(function() {
                let page = 1; // Halaman awal adalah 1
                let isLoading = false;
                let hasMorePages = true;

                // Fungsi untuk memuat post baru menggunakan jQuery AJAX
                function loadMorePosts() {
                    if (isLoading || !hasMorePages) return;

                    isLoading = true;
                    page++; // Naikkan nomor halaman untuk request selanjutnya

                    $.ajax({
                        url: `/blog/load-more?page=${page}`,
                        type: 'GET',
                        beforeSend: function() {
                            $('#loading-indicator').show();
                        },
                        success: function(response) {
                            if (response.data.length > 0) {
                                $.each(response.data, function(index, post) {
                                    const postHtml = `
                                <div class="bg-white rounded-lg border border-gray-200 flex flex-col">
                                    <a href="/blog/${post.slug}" class="block">
                                        <img src="${post.image_url}" alt="Blog post image" class="w-full h-48 object-cover rounded-t-lg">
                                    </a>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center space-x-2">
                                                <img class="w-8 h-8 rounded-full" src="${post.author_avatar}" alt="Author avatar">
                                                <div class="text-xs text-gray-500">
                                                    <p class="font-semibold text-gray-800">${post.author_name}</p>
                                                    <p>${post.published_date}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="font-bold text-lg mb-4 flex-grow">
                                            <a href="/blog/${post.slug}" class="hover:text-gray-600">${post.title.length > 75 ? post.title.substring(0, 75) + '...' : post.title}</a>
                                        </h3>
                                        <div class="border-t border-gray-200 pt-3 flex justify-between items-center text-xs text-gray-500">
                                            <div class="flex space-x-4">
                                                   <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg> ${post.views}</span>
                                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>${post.comments}</span>
                                       <span class="flex items-center"><svg class="w-4 h-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>${post.likes}</span>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                                    $('#blog-grid').append(postHtml);
                                });
                            }

                            // Cek jika tidak ada halaman selanjutnya
                            if (!response.next_page_url) {
                                hasMorePages = false;
                                $('#loading-indicator').html(
                                    '<p class="text-gray-500">Anda telah mencapai akhir.</p>');
                            } else {
                                $('#loading-indicator').hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Gagal memuat post:', textStatus, errorThrown);
                            $('#loading-indicator').html('<p class="text-red-500">Gagal memuat data.</p>');
                        },
                        complete: function() {
                            isLoading = false;
                        }
                    });
                }

                // Event listener untuk scroll
                $(window).on('scroll', function() {
                    // Cek jika pengguna sudah scroll mendekati bagian bawah halaman
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                        loadMorePosts();
                    }
                });
            });
        </script>
    @endpush
