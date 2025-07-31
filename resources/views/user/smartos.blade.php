@extends('layouts.user.main')
@section('title', 'Smart Office Solution - Fortu Digital Teknologi')
@section('content')
    <!-- Hero Section -->
    <section class="bg-purple-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <p class="text-purple-300">Fortu</p>
            <h1 class="text-4xl lg:text-5xl font-bold my-4">Smart Office Solution</h1>
            <div class="flex justify-center space-x-12 mt-8">
                <div>
                    <h2 class="text-2xl font-bold">VMS</h2>
                    <p class="text-purple-300">Visitor Management System</p>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">SMR</h2>
                    <p class="text-purple-300">Smart Meeting Room</p>
                </div>
            </div>
        </div>
    </section>

    <!-- VMS Section -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="bg-purple-800 text-white p-8 rounded-lg text-center md:w-1/4">
                    <h3 class="text-3xl font-bold">VMS</h3>
                    <p>Visitor Management System</p>
                </div>
                <div class="md:w-3/4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <img src="https://placehold.co/400x300/E9D5FF/3B0764?text=VMS+Image+1" alt="Visitor Management System 1"
                        class="rounded-lg w-full h-full object-cover">
                    <img src="https://placehold.co/400x300/DDD6FE/4C1D95?text=VMS+Image+2" alt="Visitor Management System 2"
                        class="rounded-lg w-full h-full object-cover">
                    <img src="https://placehold.co/400x300/C4B5FD/5B21B6?text=VMS+Image+3" alt="Visitor Management System 3"
                        class="rounded-lg w-full h-full object-cover">
                </div>
            </div>
            <div class="mt-12">
                <img src="https://placehold.co/1200x250/F3F4F6/4B5563?text=Alur+Proses+VMS" alt="Alur Proses VMS"
                    class="w-full rounded-lg">
            </div>
        </div>
    </section>

    <!-- SMR Section -->
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="bg-purple-800 text-white p-8 rounded-lg text-center md:w-1/4">
                    <h3 class="text-3xl font-bold">SMR</h3>
                    <p>Smart Meeting Room</p>
                </div>
                <div class="md:w-3/4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <img src="https://placehold.co/400x300/E9D5FF/3B0764?text=SMR+Image+1" alt="Smart Meeting Room 1"
                        class="rounded-lg w-full h-full object-cover">
                    <img src="https://placehold.co/400x300/DDD6FE/4C1D95?text=SMR+Image+2" alt="Smart Meeting Room 2"
                        class="rounded-lg w-full h-full object-cover">
                    <img src="https://placehold.co/400x300/C4B5FD/5B21B6?text=SMR+Image+3" alt="Smart Meeting Room 3"
                        class="rounded-lg w-full h-full object-cover">
                </div>
            </div>
            <div class="mt-12">
                <img src="https://placehold.co/1200x250/F3F4F6/4B5563?text=Alur+Proses+SMR" alt="Alur Proses SMR"
                    class="w-full rounded-lg">
            </div>
        </div>
    </section>
@endsection
