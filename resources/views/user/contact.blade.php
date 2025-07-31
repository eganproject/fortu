@extends('layouts.user.main')
@section('title', 'Contact Us - Fortu Digital Teknologi')
@push('cssOnPage')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Style untuk latar belakang diagonal */
        .contact-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 65%;
            /* Ketinggian area ungu */
            background: linear-gradient(to bottom right, #535353, #979798);
            /* Gradasi ungu */
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
            /* Bentuk diagonal */
            z-index: 0;
        }
    </style>
@endpush
@section('content')
    <!-- Contact Section -->
    <section class="relative contact-bg py-16 lg:py-24">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <p class="font-semibold text-stone-200 mb-2">Punya Pertanyaan ?</p>
                <h1 class="text-4xl lg:text-5xl font-bold max-w-3xl mx-auto">We are ready to bring the best digital solution
                    display for your business</h1>
            </div>

            <!-- Contact Form Card -->
            <div class="bg-white text-gray-800 max-w-2xl mx-auto rounded-2xl p-8 lg:p-12 shadow-2xl text-left mt-12">
                <form id="contactForm" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                class="w-full px-4 py-3 bg-stone-100 border border-stone-200 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required>
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Handphone</label>
                            <input type="number" name="phone_number" id="phone_number" placeholder="Nomor Handphone"
                                class="w-full px-4 py-3 bg-stone-100 border border-stone-200 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="w-full px-4 py-3 bg-stone-100 border border-stone-200 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required>
                    </div>
                    <div class="mb-8">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea name="message" id="message" rows="6" placeholder="Type your message here"
                            class="w-full px-4 py-3 bg-stone-100 border border-stone-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="bg-stone-500 text-white font-bold py-3 px-10 rounded-full transition-colors duration-300 shadow-lg hover:shadow-xl hover:bg-stone-600">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
            <div id="notification"
                class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-black bg-opacity-50 hidden justify-center items-center z-50"
                aria-hidden="true">
                <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm mx-auto">
                    <p id="notification-message" class="text-gray-700"></p>
                    <button type="button" class="bg-stone-500 text-white font-bold mt-4 w-full rounded-full py-2 px-4 transition-colors duration-300 shadow-lg hover:shadow-xl hover:bg-stone-600"
                        onclick="document.getElementById('notification').classList.add('hidden')">Tutup</button>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('jsOnPage')
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser

            const formData = new FormData(this);

            fetch('/contact', { // Replace '#' with the URL you want to POST to
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Required for Laravel AJAX requests
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Assuming the server returns a JSON with a success message
                    if (data.success) {
                        showNotification(data.message); // Show success notification
                    // Clear the form inputs
                    document.getElementById('contactForm').reset();
                    } else {
                        showNotification('Oops, Mohon maaf, sepertinya form ini sedang dalam perbaikan !'); // Show error notification
                    }
                })
                .catch(error => console.error('Error:', error));
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
