@extends('layouts.user.main')
@section('title', 'Career - Fortu Digital Teknologi')
@section('content')
    <!-- Hero Image Section -->
    <section>
        <div class="w-full h-80 bg-gray-200">
            <img src="https://placehold.co/1920x500/E9D5FF/3B0764?text=Wanita+Karir" alt="Woman holding books in a city"
                class="w-full h-full object-cover">
        </div>
    </section>

    <!-- Form Section -->
    <section class="bg-purple-800 py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="text-center text-white mb-12">
                <h1 class="text-3xl font-bold">Our team is growing fast.</h1>
                <p class="text-lg text-purple-200 mt-2">We'd love your help in making Fortu truly special.</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white max-w-3xl mx-auto rounded-2xl p-8 lg:p-12 shadow-2xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Come Join With Us</h2>

                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first-name" id="first-name"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last-name" id="last-name"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" name="address" id="address"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" id="phone"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Select
                                Position</label>
                            <select name="position" id="position"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option>Software Engineer</option>
                                <option>Product Manager</option>
                                <option>UI/UX Designer</option>
                                <option>Marketing Specialist</option>
                            </select>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="resume-link" class="block text-sm font-medium text-gray-700 mb-1">Link to Your
                                Resume (Optional)</label>
                            <input type="url" name="resume-link" id="resume-link"
                                class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label for="cv-upload" class="block text-sm font-medium text-gray-700 mb-1">Upload CV</label>
                            <label for="cv-upload"
                                class="w-full flex items-center justify-center px-4 py-3 bg-purple-50 border-transparent rounded-lg cursor-pointer hover:bg-purple-100">
                                <span class="text-gray-500">Upload CV</span>
                                <svg class="w-5 h-5 ml-2 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </label>
                            <input id="cv-upload" name="cv-upload" type="file" class="sr-only">
                            <p class="text-xs text-gray-400 mt-1">Supported file: PDF, MS Word (Max. 5Mb)</p>
                        </div>
                    </div>

                    <!-- Submission -->
                    <div class="pt-6">
                        <div class="flex items-center mb-6">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-900">
                                I agree to the <a href="#"
                                    class="font-medium text-purple-600 hover:text-purple-500">terms & conditions</a>
                            </label>
                        </div>
                        <div class="text-left">
                            <button type="submit"
                                class="bg-purple-700 text-white font-bold py-3 px-12 rounded-lg hover:bg-purple-800 transition-colors duration-300">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
