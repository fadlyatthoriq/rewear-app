<!-- footer -->
<footer class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Brand & Social Section -->
        <div class="col-span-1 space-y-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="w-28 transform hover:scale-105 transition-transform duration-300">
            <div class="mr-2">
                <p class="text-gray-500">
                    Your trusted marketplace for quality preloved fashion. Join us in promoting sustainable fashion by buying and selling second-hand clothing items.
                </p>
            </div>
        </div>

        <!-- Shop Categories -->
        <div class="col-span-1">
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Shop</h3>
            <div class="mt-4 space-y-4">
                @foreach($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}" class="text-base text-gray-500 hover:text-[#2596be] transition-all duration-300 block transform hover:translate-x-2">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-span-1">
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Contact</h3>
            <div class="mt-4 space-y-4">
                <p class="text-base text-gray-500">
                    <i class="fa-solid fa-location-dot mr-2"></i>
                    Jl. Boulevard Grand Depok City, Tirtajaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16412
                </p>
                <p class="text-base text-gray-500">
                    <i class="fa-solid fa-phone mr-2"></i>
                    +62 812-9202-0429
                </p>
                <p class="text-base text-gray-500">
                    <i class="fa-solid fa-envelope mr-2"></i>
                    yahdinoyy@gmail.com
                </p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container mt-12 pt-8 border-t border-gray-100">
        <p class="text-center text-gray-500">
            &copy; {{ date('Y') }} Rewear. All rights reserved.
        </p>
    </div>
</footer>

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