@extends('layouts.user.main')
@section('title', 'Become a Partner - Fortu Digital Teknologi')
@section('content')
    <!-- Hero Image Section -->
    <section>
        <div class="w-full h-64 bg-gray-200">
            <img src="https://placehold.co/1920x400/E9D5FF/3B0764?text=Wanita+Bekerja" alt="Woman working on a laptop"
                class="w-full h-full object-cover">
        </div>
    </section>

    <!-- Form Section -->
    <section class="bg-purple-800 py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <!-- Form Card -->
            <div class="bg-white max-w-3xl mx-auto rounded-2xl p-8 lg:p-12 shadow-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Apply Become a Partner</h1>
                    <p class="text-gray-500 mt-2">To apply, please take the time to fill out the information below.</p>
                </div>

                <form action="#" method="POST" class="space-y-8">
                    <!-- Personal Info -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-2">Personal Info</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Complete Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="job-title" class="block text-sm font-medium text-gray-700 mb-1">Job Title <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="job-title" id="job-title"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="telephone"
                                    class="block text-sm font-medium text-gray-700 mb-1">Telephone</label>
                                <input type="tel" name="telephone" id="telephone"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="mobile-phone" class="block text-sm font-medium text-gray-700 mb-1">Mobile Phone
                                    <span class="text-red-500">*</span></label>
                                <input type="tel" name="mobile-phone" id="mobile-phone"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>

                    <!-- Company Details -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-2">Company Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company-name" class="block text-sm font-medium text-gray-700 mb-1">Company Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="company-name" id="company-name"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="company-telephone"
                                    class="block text-sm font-medium text-gray-700 mb-1">Telephone <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="company-telephone" id="company-telephone"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="company-address" class="block text-sm font-medium text-gray-700 mb-1">Company
                                    Address <span class="text-red-500">*</span></label>
                                <input type="text" name="company-address" id="company-address"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="fax" class="block text-sm font-medium text-gray-700 mb-1">Fax</label>
                                <input type="text" name="fax" id="fax"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="city" id="city"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Company
                                    Website</label>
                                <input type="url" name="website" id="website" placeholder="https://"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="state" id="state"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="employees" class="block text-sm font-medium text-gray-700 mb-1">Number of
                                    Employees <span class="text-red-500">*</span></label>
                                <select name="employees" id="employees"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option>1-10</option>
                                    <option>11-50</option>
                                    <option>51-200</option>
                                    <option>201+</option>
                                </select>
                            </div>
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="country" id="country"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="years" class="block text-sm font-medium text-gray-700 mb-1">Years in
                                    Business</label>
                                <input type="number" name="years" id="years"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="zip" id="zip"
                                    class="w-full px-4 py-3 bg-purple-50 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>

                    <!-- Submission -->
                    <div class="mt-8">
                        <div class="flex items-center justify-center mb-6">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-900">
                                I agree to the <a href="#"
                                    class="font-medium text-purple-600 hover:text-purple-500">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="text-center">
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
