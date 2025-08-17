    @extends('layouts.user.main')
    @section('title', 'Blog - Fortu Digital Teknologi')
    @section('content')

        <section id="blog-hero" class="relative overflow-hidden py-20 bg-gradient-to-b from-silver-50 to-silver-100/60">
            <div class="absolute inset-0 metal noise opacity-50"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                <div class="text-center reveal">
                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl tracking-tight">
                        FORTU <span class="u-accent">Insights</span>
                    </h1>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-silver-700">
                        Jelajahi tren terbaru, studi kasus mendalam, dan panduan ahli di dunia komunikasi visual dan digital
                        signage.
                    </p>
                </div>

                <!-- Featured Article -->
                <div class="mt-16 reveal" style="--reveal-delay: 0.2s;">
                    <a href="/blog/{{ $blog[0]?->slug }}"
                        class="block group relative rounded-3xl overflow-hidden metal-dark border border-white/70 shadow-ring hover:shadow-neo transition-shadow duration-300">
                        <div class="grid lg:grid-cols-2">
                            <div class="relative h-64 lg:h-auto">
                                <img src="{{ $blog[0] ? asset('public/storage/' . $blog[0]->image) : 'https://placehold.co/1200x500/C7C7C7/FFFFFF?text=IMG+Post' }}"
                                    alt="Featured Article Image"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-silver-900/50 to-transparent lg:bg-gradient-to-r lg:from-silver-900/20 lg:to-transparent">
                                </div>
                            </div>
                            <div class="p-8 lg:p-12 flex flex-col justify-center">
                                <div>
                                    <span
                                        class="inline-flex items-center gap-2 text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1 g-border">
                                        <i data-lucide="star" class="w-4 h-4 text-accent-600"></i>
                                        Artikel Unggulan
                                    </span>
                                </div>
                                <!-- PERUBAHAN: Warna teks judul diubah -->
                                <h2 class="font-display text-2xl sm:text-3xl mt-4 text-silver-900">
                                    {{ Str::limit($blog[0] ? $blog[0]->title : 'Belum ada post', 50) }}
                                </h2>
                                <!-- PERUBAHAN: Warna teks deskripsi diubah -->
                                <p class="mt-3 text-silver-700">
                                    {{ Str::limit($blog[0] ? strip_tags($blog[0]->text) : 'Belum ada post', 230) }}
                                </p>
                                <!-- PERUBAHAN: Warna teks link diubah -->
                                <div
                                    class="mt-6 flex items-center gap-2 font-medium text-sm text-silver-800 group-hover:text-silver-950 transition-colors">
                                    Baca Selengkapnya
                                    <i data-lucide="arrow-right"
                                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>


        <section id="blog-list" class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal text-center max-w-2xl mx-auto">
                    <h2 class="font-display text-3xl sm:text-4xl">Artikel <span class="u-accent">Terbaru</span></h2>
                    <p class="mt-3 text-silver-700">Tetap terdepan dengan wawasan terbaru dari industri.</p>
                </div>
                <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Article 1 -->
                    @foreach ($blog as $item)
                        <article
                            class="reveal group rounded-2xl border bg-white overflow-hidden hover:shadow-neo transition" style="--reveal-delay: 0.15s;">
                            <a href="/blog/{{ $item->slug }}">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $item->image ? asset('public/storage/' . $item->image) : 'https://placehold.co/400x250/E9D5FF/3B0764?text=Blog+Post' }}"
                                        alt="Article Image" class="w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-6">
                                    <h3 class="font-medium group-hover:text-silver-950 transition-colors">
                                        {{ Str::limit($item->title, 75) }}</h3>
                                    <p class="text-sm text-silver-700 mt-2">{{ Str::limit(strip_tags($item->text), 150) }}
                                    </p>
                                    <div
                                        class="mt-4 pt-4 border-t border-silver-100 flex flex-wrap items-center justify-between text-xs text-silver-600 gap-y-2">
                                        <div class="flex items-center gap-2"><i data-lucide="calendar"
                                                class="w-4 h-4"></i><span>
                                                @if (Carbon\Carbon::parse($item->tanggal)->isToday())
                                                    {{ Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->diffForHumans() }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->format('d F Y') }}
                                                @endif
                                            </span></div>
                                        <div class="flex items-center gap-4">
                                            <span class="flex items-center gap-1.5"><i data-lucide="eye"
                                                    class="w-4 h-4"></i>{{ $item->views }}</span>
                                            <span class="flex items-center gap-1.5"><i data-lucide="heart"
                                                    class="w-4 h-4"></i>{{ $item->likes }}</span>
                                            <span class="flex items-center gap-1.5"><i data-lucide="message-square"
                                                    class="w-4 h-4"></i>{{ $item->comments }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                    <!-- Article 2 -->
                    <div id="loading-indicator" class="text-center py-8 hidden">
                        <p class="text-gray-500">Memuat lebih banyak post...</p>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @push('jsOnPage')
        <script>
            // Lucide
            lucide.createIcons();

            // Mobile menu toggle
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            menuBtn?.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const isOpen = !mobileMenu.classList.contains('hidden');
                menuBtn.innerHTML = isOpen ? '<i data-lucide="x"></i>' : '<i data-lucide="menu"></i>';
                lucide.createIcons();
            });

            // Reveal on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

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
