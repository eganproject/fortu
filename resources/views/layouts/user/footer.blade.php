<footer class="bg-gray-100 text-gray-700 pt-16 pb-8 text-sm px-4">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-1">
                @php
                    $footer = getFooterUser();
                @endphp
                {{-- Ganti dengan path logo yang benar via asset() helper --}}
                <img src="{{ $footer['logoUrl'] }}" alt="Logo" class="h-8 w-auto mb-4">
                <ul class="space-y-2">
                    <li><a href="/about" class="hover:text-purple-600 font-medium">About Us</a></li>
                    <li><a href="/service" class="hover:text-purple-600 font-medium">Service</a></li>
                    <li><a href="/product" class="hover:text-purple-600 font-medium">Product</a></li>
                    <li><a href="/contact" class="hover:text-purple-600 font-medium">Contact</a></li>
                </ul>
            </div>

            <div class="lg:col-span-1">
                <h3 class="font-bold mb-3 text-gray-800">Alamat</h3>
                <p class="leading-relaxed">
                    {{ $footer['company']?->address_1 }}
                </p>
                <p class="mt-3">Telp : {{ $footer['company']?->contact_number }}</p>
                {{-- <p>Fax : +62 21 520 9845</p> --}}
            </div>


            <div class="lg:col-span-1">
                <h3 class="font-bold mb-3 text-gray-800">Partnership / Reseller | E-katalog</h3>
                <p>Mobile : {{ $footer['company']?->whatsapp }}</p>
                <p>Email : {{ $footer['company']?->email }}</p>
            </div>
        </div>

        <div class="border-t border-gray-300 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs">
            <div class="flex space-x-4 mb-4 sm:mb-0">

                <a href="https://www.instagram.com/{{ $footer['company']?->instagram ? $footer['company']?->instagram : '#' }}"
                    class="text-gray-500 hover:text-pink-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
                <a href="https://www.youtube.com/{{ $footer['company']?->youtube ? $footer['company']?->youtube : '#' }}"
                    class="text-gray-500 hover:text-red-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.42 4.814a2.506 2.506 0 0 1-1.768 1.768C18.398 19 12 19 12 19s-6.398 0-7.812-1.418a2.506 2.506 0 0 1-1.768-1.768C2 15.22 2 12 2 12s0-3.22.42-4.814a2.506 2.506 0 0 1 1.768-1.768C5.602 5 12 5 12 5s6.398 0 7.812.418zM9.545 15.568V8.432L15.818 12 9.545 15.568z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/in/{{ $footer['company']?->linkedin ? $footer['company']?->linkedin : '#' }}"
                    class="text-gray-500 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                        </path>
                    </svg>
                </a>
                <a href="https://wa.wizard.id/fd9164" class="text-gray-500 hover:text-green-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.457l-6.354 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="text-center sm:text-right">
                <p>&copy;2019 by {{ $footer['company']?->company_name }}. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

<a href="https://wa.wizard.id/fd9164" class="whatsapp-float" target="_blank"
    rel="noopener noreferrer">
{{-- <a href="https://wa.me/{{ $footer['company']?->whatsapp }}" class="whatsapp-float" target="_blank"
    rel="noopener noreferrer"> --}}
    <img src="{{ asset('public/image/wa.png') }}" alt="WhatsApp" class="whatsapp-icon">
</a>
