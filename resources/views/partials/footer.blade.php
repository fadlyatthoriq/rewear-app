<!-- footer -->
<footer class="bg-gradient-to-b from-white to-gray-50 pt-20 pb-16 border-t border-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Brand & Social Section -->
            <div class="col-span-1 space-y-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="w-32 transform hover:scale-105 transition-transform duration-300 filter drop-shadow-sm">
                <div>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Your trusted marketplace for quality preloved fashion. Join us in promoting sustainable fashion by buying and selling second-hand clothing items.
                    </p>
                </div>
                <!-- Social Media Links -->
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#2596be] hover:text-white transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#2596be] hover:text-white transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#2596be] hover:text-white transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#2596be] hover:text-white transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Shop Categories -->
            <div class="col-span-1">
                <h3 class="text-base font-semibold text-gray-900 mb-6 relative inline-block after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-[#2596be]">Shop Categories</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category->id]) }}" 
                           class="text-gray-600 hover:text-[#2596be] transition-all duration-300 flex items-center group">
                            <span class="w-1.5 h-1.5 bg-[#2596be] rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <span class="text-sm md:text-base">{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-span-1">
                <h3 class="text-base font-semibold text-gray-900 mb-6 relative inline-block after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-[#2596be]">Contact Info</h3>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4 group">
                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#2596be] flex-shrink-0 group-hover:bg-[#2596be] group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                            Jl. Boulevard Grand Depok City, Tirtajaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16412
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 group">
                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#2596be] flex-shrink-0 group-hover:bg-[#2596be] group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <a href="tel:+6281292020429" class="text-gray-600 hover:text-[#2596be] transition-colors duration-300 text-sm md:text-base">
                            +62 812-9202-0429
                        </a>
                    </div>
                    <div class="flex items-center space-x-4 group">
                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#2596be] flex-shrink-0 group-hover:bg-[#2596be] group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <a href="mailto:yahdinoyy@gmail.com" class="text-gray-600 hover:text-[#2596be] transition-colors duration-300 text-sm md:text-base">
                            yahdinoyy@gmail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-12 pt-8 border-t border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-600 text-center md:text-left text-sm">
                    &copy; {{ date('Y') }} Rewear. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- back to top button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-[#2596be] text-white w-12 h-12 rounded-full flex items-center justify-center opacity-0 invisible transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#2596be] focus:ring-opacity-50 backdrop-blur-sm">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<script>
    // Back to top button functionality
    const backToTopButton = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
            backToTopButton.classList.remove('opacity-100', 'visible');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>