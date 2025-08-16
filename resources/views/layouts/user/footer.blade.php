<footer class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $footer = getFooterUser();
        @endphp
        <div class="border rounded-3xl p-6 md:p-8 metal-dark">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ $footer['logoUrl'] }}" alt="Logo" class="h-8 w-auto">
                        <span class="font-display text-lg">{{ $footer['company']?->company_name }}</span>
                    </div>
                    
                    <!-- Enhanced Contact Information Section -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 text-silver-700">
                            <i data-lucide="map-pin" class="w-5 h-5 mt-1 flex-shrink-0 text-accent-500"></i>
                            <div>
                                <h5 class="font-medium text-silver-900 mb-1">Alamat Kantor</h5>
                                <p class="leading-relaxed">
                                    {{ $footer['company']?->address_1 }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 text-silver-700">
                            <i data-lucide="phone" class="w-5 h-5 mt-1 flex-shrink-0 text-accent-500"></i>
                            <div>
                                <h5 class="font-medium text-silver-900 mb-1">Telepon</h5>
                                <a href="tel:{{ $footer['company']?->contact_number }}" 
                                   class="hover:text-accent-500 transition-colors">
                                    {{ $footer['company']?->contact_number }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 text-silver-700">
                            <i data-lucide="mail" class="w-5 h-5 mt-1 flex-shrink-0 text-accent-500"></i>
                            <div>
                                <h5 class="font-medium text-silver-900 mb-1">Email</h5>
                                <a href="mailto:{{ $footer['company']?->email }}" 
                                   class="hover:text-accent-500 transition-colors">
                                    {{ $footer['company']?->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium">Menu</h4>
                    <ul class="mt-3 space-y-2 text-sm text-silver-800">
                        <li><a href="/" class="hover:underline">Beranda</a></li>
                        <li><a href="/about" class="hover:underline">About Us</a></li>
                        <li><a href="/service" class="hover:underline">Service</a></li>
                        <li><a href="/product" class="hover:underline">Product</a></li>
                        <li><a href="/contact" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-medium">Ikuti Kami</h4>
                    <div class="mt-3 flex items-center gap-3">
                        <a href="https://www.instagram.com/{{ $footer['company']?->instagram ?: '#' }}"
                            class="p-2 rounded-lg hover:bg-white/60">
                            <i data-lucide="instagram"></i>
                        </a>

                        <a href="https://wa.wizard.id/fd9164" class="p-2 rounded-lg hover:bg-white/60">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.457l-6.354 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z">
                                </path>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/in/{{ $footer['company']?->linkedin ?: '#' }}"
                            class="p-2 rounded-lg hover:bg-white/60">
                            <i data-lucide="linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-silver-200/20 text-xs text-silver-600">
                © <span id="year"></span> {{ $footer['company']?->company_name }}. All rights reserved.
            </div>
        </div>
    </div>
</footer>

<!-- Enhanced WhatsApp Float Button -->
<a href="https://wa.wizard.id/fd9164" 
   class="whatsapp-float group fixed top-1/2 -translate-y-1/2 right-6 z-50 flex items-center gap-3 pr-3 pl-3 py-3 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transition-all duration-300" 
   target="_blank" 
   rel="noopener noreferrer">
    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.457l-6.354 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
    </svg>
</a>
