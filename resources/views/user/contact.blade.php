@extends('layouts.user.main')
@section('title', 'Contact Us - Fortu Digital Teknologi')
@push('cssOnPage')
@endpush
@section('content')
    <section id="kontak" class="py-20 bg-gradient-to-b from-silver-50 to-silver-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-5 gap-10">
            <div class="lg:col-span-2 reveal">
                <h2 class="font-display text-3xl sm:text-4xl"><span class="u-accent">Kontak</span></h2>
                <p class="mt-3 text-silver-700">Butuh demo atau penawaran? Kirim pesan — kami respons cepat.</p>
                <div class="mt-6 space-y-3 text-silver-800">
                    <div class="flex items-center gap-3"><i data-lucide="mail"></i> hello@fortu.id</div>
                    <div class="flex items-center gap-3"><i data-lucide="phone"></i> +62 812‑0000‑0000</div>
                    <div class="flex items-center gap-3"><i data-lucide="map-pin"></i> Jakarta, Indonesia</div>
                </div>
            </div>
            <div class="lg:col-span-3 reveal">
                <form class="rounded-3xl border bg-white p-6 md:p-8" id="contactForm">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-silver-700">Nama</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 w-full rounded-xl border-silver-300 focus:border-silver-600 focus:ring-silver-600"
                                placeholder="Nama Anda" />
                        </div>
                        <div>
                            <label class="block text-sm text-silver-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 w-full rounded-xl border-silver-300 focus:border-silver-600 focus:ring-silver-600"
                                placeholder="email@domain.com" />
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-silver-700">No Telpon</label>
                            <input type="text" name="phone_number" id="phone_number"
                                class="mt-1 w-full rounded-xl border-silver-300 focus:border-silver-600 focus:ring-silver-600"
                                placeholder="080000000" />
                        </div>

                        <div class="md:col-span-2 mt-2">
                            <label class="block text-sm text-silver-700">Pesan</label>
                            <textarea rows="5" class="mt-1 w-full rounded-xl border-silver-300 focus:border-silver-600 focus:ring-silver-600"
                                name="message" id="message" placeholder="Ceritakan kebutuhan Anda"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs text-silver-600"><i data-lucide="lock"></i> Data
                            terlindungi</div>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-silver-900 text-white hover:shadow-neo"><i
                                data-lucide="send"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div id="notification"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-black bg-opacity-50 hidden justify-center items-center z-50"
        aria-hidden="true">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm mx-auto">
            <p id="notification-message" class="text-gray-700"></p>
            <button type="button"
                class="bg-black text-white font-bold mt-4 w-full rounded-full py-2 px-4 transition-colors duration-300 shadow-lg hover:shadow-xl hover:bg-gray-700"
                onclick="document.getElementById('notification').classList.add('hidden')">Tutup</button>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-full p-6 shadow-lg flex flex-col items-center">
            <svg class="animate-spin h-8 w-8 text-silver-900 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <span class="text-silver-900 text-sm">Mengirim...</span>
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

        // Year
        document.getElementById('year').textContent = new Date().getFullYear();

        // Loading overlay
        const loadingOverlay = document.getElementById('loading-overlay');

        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser

            const formData = new FormData(this);

            // Show loading overlay
            loadingOverlay.classList.remove('hidden');

            fetch('/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    loadingOverlay.classList.add('hidden'); // Hide loading overlay
                    if (data.success) {
                        showNotification(data.message);
                        document.getElementById('contactForm').reset();
                    } else {
                        showNotification('Oops, Mohon maaf, sepertinya form ini sedang dalam perbaikan !');
                    }
                })
                .catch(error => {
                    loadingOverlay.classList.add('hidden'); // Hide loading overlay
                    showNotification('Terjadi kesalahan. Silakan coba lagi nanti.');
                    console.error('Error:', error);
                });
        });

        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');

        function showNotification(message) {
            notification.classList.remove('hidden');
            notificationMessage.innerText = message;
            setTimeout(() => notification.classList.add('hidden'), 5000);
        }
    </script>
@endpush
