<!-- Header -->
<header class="sticky top-0 z-50 bg-white shadow">
  <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-3 md:gap-6">
    <!-- Logo -->
    <a href="/" class="flex items-center space-x-2 hover:opacity-90 transition">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Rewear Logo" class="w-24 md:w-32">
    </a>

    <!-- Icons -->
    <div class="flex items-center space-x-4 md:space-x-5 text-gray-600">
      <a href="{{ route('wishlist.index') }}" class="relative group">
        <i class="fa-regular fa-heart text-xl group-hover:text-[#2596be] transition"></i>
        @if($wishlistCount > 0)
        <span class="absolute -top-2 -right-2 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow">{{ $wishlistCount }}</span>
        @endif
      </a>
      <a href="/cart" class="relative group">
        <i class="fa-solid fa-bag-shopping text-xl group-hover:text-[#2596be] transition"></i>
        @if($cartCount > 0)
        <span class="absolute -top-2 -right-2 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow cart-count">{{ $cartCount }}</span>
        @endif
      </a>
      @auth
        <div class="relative group">
          <button class="flex items-center group focus:outline-none">
            <i class="fa-regular fa-user text-xl group-hover:text-[#2596be] transition"></i>
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-white text-gray-700 shadow-xl rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 divide-y divide-gray-100 z-20">
            <a href="{{ route('account') }}" class="block px-4 py-3 hover:bg-gray-50 transition text-sm">Account Setting</a>
            <a href="{{ route('my-orders') }}" class="block px-4 py-3 hover:bg-gray-50 transition text-sm">My Orders</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-3 hover:bg-gray-50 transition text-sm">Logout</button>
            </form>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="group">
          <i class="fa-regular fa-user text-xl group-hover:text-[#2596be] transition"></i>
        </a>
      @endauth
  </div>
</header>

<!-- Navbar -->
<nav class="bg-[#1a2233] text-white shadow">
  <div class="container mx-auto px-4 flex items-center justify-between h-14 md:h-16">
    <!-- Categories Dropdown -->
    <div class="relative group flex-shrink-0">
      <button class="flex items-center px-4 py-2 bg-[#2596be] hover:bg-[#217ca6] rounded font-medium transition shadow text-sm md:text-base">
        <i class="fa-solid fa-bars mr-2"></i> All Categories
      </button>
      <div
        class="absolute top-full left-0 mt-2 w-56 md:w-64 bg-white text-gray-700 shadow-xl rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 divide-y divide-gray-100 z-20">
        @php
            $icons = [
                'Women\'s' => 'person-dress',
                'Men\'s' => 'person',
                'Health & Beauty' => 'spa',
                'Babies & Kids' => 'baby',
                'Luxury' => 'crown',
                'Electronics' => 'laptop',
                'T-Shirts' => 'shirt',
                'Hoodies' => 'hoodie',
                'Pants' => 'socks',
                'Shoes' => 'shoe-prints',
                'Accessories' => 'glasses'
            ];
        @endphp
        @foreach($categories as $category)
        <a href="{{ route('shop', ['category' => $category->id]) }}" class="flex items-center px-6 py-4 hover:bg-gray-50 transition text-sm border-b border-gray-100 last:border-b-0">
          <i class="fa-solid fa-{{ $icons[$category->name] ?? 'tag' }} w-5 h-5 mr-5 text-[#2596be]"></i>
          <span class="font-medium">{{ $category->name }}</span>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex items-center space-x-6 ml-6">
      <a href="/" class="{{ request()->is('/') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition font-semibold text-sm md:text-base">Home</a>
      <a href="/shop" class="{{ request()->is('shop*') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition font-semibold text-sm md:text-base">Shop</a>
      @guest
        <a href="{{ route('login') }}" class="{{ request()->is('login*') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition font-semibold text-sm md:text-base">Login</a>
      @endguest
    </div>
  </div>
</nav>
