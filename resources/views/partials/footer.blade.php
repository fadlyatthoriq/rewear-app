<!-- footer -->
<footer class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Brand & Social Section -->
        <div class="col-span-1 space-y-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="w-28 transform hover:scale-105 transition-transform duration-300">
            <div class="mr-2">
                <p class="text-gray-500">
                    Your one-stop destination for trendy fashion. Discover the latest styles in clothing, accessories, and more.
                </p>
            </div>
        </div>

        <!-- Shop Categories -->
        <div class="col-span-1">
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Shop</h3>
            <div class="mt-4 space-y-4">
                @foreach (['Women', 'Men', 'Accessories', 'New Arrivals'] as $link)
                    <a href="#" class="text-base text-gray-500 hover:text-[#2596be] transition-all duration-300 block transform hover:translate-x-2">{{ $link }}</a>
                @endforeach
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-span-1">
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Contact Us</h3>
            <div class="mt-4 space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-location-dot text-[#2596be]"></i>
                    <p class="text-gray-500 ml-3">123 Fashion Street, Jakarta</p>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-phone text-[#2596be]"></i>
                    <p class="text-gray-500 ml-3">+62 812 3456 7890</p>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-envelope text-[#2596be]"></i>
                    <p class="text-gray-500 ml-3">support@rewear.com</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ./footer -->

<!-- copyright -->
<div class="bg-gray-800 py-4">
    <div class="container flex items-center justify-between">
        <p class="text-white">&copy; {{ date('Y') }} Rewear - Your Fashion Destination</p>
    </div>
</div>
<!-- ./copyright -->

<!-- back to top button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-[#2596be] text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 invisible transition-all duration-300 transform hover:scale-110">
    <i class="fa-solid fa-arrow-up"></i>
</button>
<!-- ./back to top button -->

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