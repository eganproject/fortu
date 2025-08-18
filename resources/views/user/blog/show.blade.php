@extends('layouts.user.main')
@section('title', 'Blog - Fortu Digital Teknologi')
@section('content')

    <div class="container mx-auto px-4 max-w-4xl py-4">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-8">
            <a href="/blog" class="text-sm font-semibold text-gray-600 hover:text-purple-700">&larr; All Posts</a>

        </div>

        <!-- Article Header -->
        <div class="mb-8">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center space-x-3">
                    <img class="w-10 h-10 rounded-full" src="https://placehold.co/40x40/CFD8DC/78909C?text=A"
                        alt="Author avatar">
                    <div class="text-sm">
                        <p class="font-semibold text-gray-800">{{ $blog->user->name }}</p>
                        <p class="text-gray-500">
                            @if (Carbon\Carbon::parse($blog->tanggal)->isToday())
                                {{ Carbon\Carbon::parse($blog->tanggal)->locale('id_ID')->diffForHumans() }}
                            @else
                                {{ \Carbon\Carbon::parse($blog->tanggal)->locale('id_ID')->format('d F Y') }}
                            @endif
                        </p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                </button>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                {{ $blog->title }}
            </h1>
        </div>

        <!-- Featured Image -->
        <div class="mb-8 flex justify-center">
            <img src="{{ $blog->image ? asset('public/storage/' . $blog->image) : 'https://placehold.co/800x500/FCA5A5/7F1D1D?text=Event+Image' }}"
                alt="Image Event Blog" class="w-full rounded-lg max-h-[600px] object-contain">
        </div>

        <!-- Article Body -->
        <article class="prose max-w-none text-gray-700 leading-relaxed">
            {{-- <div class="flex items-center space-x-4 mb-6 border-y py-3">
                <img src="https://placehold.co/80x30/CCCCCC/FFFFFF?text=Logo1" alt="Partner Logo 1">
                <img src="https://placehold.co/80x30/CCCCCC/FFFFFF?text=Logo2" alt="Partner Logo 2">
                <img src="https://placehold.co/80x30/CCCCCC/FFFFFF?text=Logo3" alt="Partner Logo 3">
            </div> --}}
            {!! $blog->text !!}
        </article>

        <!-- Post Footer -->
        <div class="mt-8">
            <div class="flex items-center text-blue-800 font-semibold mb-4">

                <span class="ml-2">#fortudigitalsignage #tviklan #monitoriklan</span>
            </div>
            <div class="border-t border-b py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4 text-gray-600">
                    <a href="#" class="hover:text-blue-800"><svg class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M9.198 21.5h4.14c.891 0 1.59-.724 1.59-1.615v-5.023h2.833c.594 0 .88-.724.47-1.123l-5.45-5.45c-.307-.307-.81-.307-1.117 0l-5.45 5.45c-.41.4-.124 1.123.47 1.123h2.833v5.023c0 .891.7 1.615 1.59 1.615z">
                            </path>
                        </svg></a>
                  
                    <a href="/blog" class="hover:text-blue-800"><svg class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M13.423 12.601c.498-1.52 1.309-3.013 2.508-4.216.043.01.085.021.127.031l2.427 1.011c.92.384 1.358 1.428.974 2.348-1.472 3.535-4.23 6.365-7.75 7.855-.92.384-1.965-.053-2.348-.974l-1.011-2.427c-.01-.042-.021-.084-.031-.127 1.203-1.199 2.696-2.01 4.216-2.508zm-1.034-3.142c-.297.297-2.187-1.593-1.89-1.89.297-.297 2.187 1.593 1.89 1.89zm5.209 11.541c-3.031.09-5.912-1.038-8.12-3.249-4.444-4.444-4.444-11.667 0-16.111 2.208-2.211 5.089-3.34 8.12-3.249.342.01.666.146.904.384l2.427 1.011c.92.384 1.358 1.428.974 2.348-1.472 3.535-4.23 6.365-7.75 7.855-.92.384-1.965-.053-2.348-.974l-1.011-2.427c-.19-.456-.582-.78-1.05-.854-.23-.037-.464.01-.676.127-4.444 4.444-4.444 11.667 0 16.111 2.208 2.211 5.089 3.34 8.12 3.249.467-.015.869-.339 1.05-.854l1.011-2.427c.384-.92.053-1.965-.974-2.348l-2.427-1.011c-.238-.238-.562-.374-.904-.384z">
                            </path>
                        </svg></a>
                </div>
            </div>
            <div class="flex justify-between items-center mt-3 text-sm text-gray-500">
                <span>{{ $blog->views }} views &nbsp;&nbsp; {{ $blog->comments }} komentar</span>
                <button class="flex items-center text-red-500 hover:text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 4.248c-3.148-5.402-12-3.825-12 2.944 0 4.661 5.571 9.427 12 15.808 6.43-6.381 12-11.147 12-15.808 0-6.792-8.875-8.306-12-2.944z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Recent Posts Section -->
        <section class="mt-16 pt-8 border-t">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Recent Posts</h2>
                <a href="/blog" class="text-sm font-semibold text-purple-600 hover:underline">See All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Recent Post Card 1 -->
                @foreach ($recentPost as $item)
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <a href="#" class="block">
                            <img src="{{ asset('public/storage/' . $item->image) }}" alt="Blog post image"
                                class="w-full h-40 object-cover">
                        </a>
                        <div class="py-4 px-4">
                            <h3 class="font-bold text-md mb-3 h-16">
                                <a href="#" class="hover:text-purple-700">{{ Str::limit($item->title, 50) }}</a>
                            </h3>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <div class="flex space-x-4">
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg> {{ $item->views }}</span>
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg> {{ $item->comments }}</span>
                                </div>
                                <button class="flex items-center hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Comments Section -->
        <section class="mt-16 pt-8 border-t mb-16">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ count($comments) }} Komentar</h2>
            <div class="mb-6">
                <textarea class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3"
                    placeholder="Write a comment..." id="user_comment"></textarea>
            </div>
            <div class="flex justify-end">
                <button
                    class="bg-black text-white font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 shadow-lg hover:shadow-xl transition-all duration-300"
                    id="comment-button">
                    Kirim Komentar
                </button>
            </div>
            {{-- <div class="flex justify-start items-center mb-6">
                <label for="sort-by" class="text-sm text-gray-600 mr-2">Sort by:</label>
                <select id="sort-by" class="text-sm font-semibold border-0 focus:ring-0">
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div> --}}

            <!-- Comments List -->
            <div class="space-y-8">
                <!-- Comment 1 -->

                <!-- Comment 2 -->
                @foreach ($comments as $item)
                    <div class="flex items-start space-x-4 py-2">
                        <div
                            class="w-10 h-10 rounded-full bg-{{ ['pink', 'blue', 'green', 'yellow'][rand(0, 3)] }}-500 flex items-center justify-center text-white font-bold">
                            {{ substr($item->nama, 0, 1) }}</div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item->nama }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id_ID')->diffForHumans() }}
                                    </p>
                                </div>
                                <button class="text-gray-400 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-2 text-sm text-gray-700">
                                {{ $item->comment }}
                            </p>
                            <div class="mt-3 flex items-center space-x-4 text-xs text-gray-500 font-semibold">
                                <button class="flex items-center hover:text-gray-800"><svg class="w-4 h-4 mr-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>{{ $item->likes }} Suka</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-25 hidden" id="modal-comment">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg p-8 w-96 relative">
                <button class="absolute top-0 right-0 p-2 text-gray-400 hover:text-gray-700" id="close-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi</h2>
                <form id="comment-form">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="bg-stone-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-stone-500"
                            type="submit">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('jsOnPage')
    <script>
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

        document.getElementById('year').textContent = new Date().getFullYear();


        const commentButton = document.getElementById('comment-button');
        const modalComment = document.getElementById('modal-comment');
        const closeModal = document.getElementById('close-modal');

        commentButton.addEventListener('click', () => {
            modalComment.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            modalComment.classList.add('hidden');
        });

        modalComment.addEventListener('click', (e) => {
            if (e.target === modalComment) {
                modalComment.classList.add('hidden');
            }
        });
        document.getElementById('comment-form').addEventListener('submit', (e) => {
            e.preventDefault();
            modalComment.classList.add('hidden');
            const formData = new FormData(e.target);
            const userComment = document.getElementById('user_comment').value;
            formData.append('comment', userComment);

            fetch('/blog/comment', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notificationModal = document.createElement('div');
                        notificationModal.classList.add('fixed', 'top-1/2', 'left-1/2', 'transform',
                            '-translate-x-1/2', '-translate-y-1/2', 'max-w-md', 'w-full', 'p-6',
                            'bg-gradient-to-r', 'from-purple-500', 'to-indigo-500', 'rounded-2xl',
                            'shadow-2xl', 'z-50', 'text-white');
                        notificationModal.innerHTML = `
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-xl">${data.message}</p>
                                </div>
                                <button class="text-white hover:text-gray-200" id="close-notification">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        `;
                        document.body.appendChild(notificationModal);
                        const closeNotification = notificationModal.querySelector('#close-notification');
                        closeNotification.addEventListener('click', () => {
                            notificationModal.remove();
                        });
                        setTimeout(() => {
                            notificationModal.remove();
                            window.location.reload();
                        }, 3000);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endpush
