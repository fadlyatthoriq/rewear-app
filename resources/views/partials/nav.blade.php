<!-- Header -->
<header class="sticky top-0 z-50 bg-white shadow-md">
  <div class="container mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4 md:gap-6">
    <!-- Logo -->
    <a href="/" class="flex items-center space-x-2 hover:opacity-90 transition duration-300">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Rewear Logo" class="w-24 md:w-32">
    </a>

    <!-- Icons -->
    <div class="flex items-center space-x-5 md:space-x-6 text-gray-600">
      <a href="{{ route('wishlist.index') }}" class="relative group p-2 hover:bg-gray-50 rounded-full transition duration-300">
        <i class="fa-regular fa-heart text-xl group-hover:text-[#2596be] transition"></i>
        @if($wishlistCount > 0)
        <span class="absolute -top-1 -right-1 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-md transform scale-100 group-hover:scale-110 transition-transform">{{ $wishlistCount }}</span>
        @endif
      </a>
      @auth
        <div class="relative">
          <button @click="openNotificationModal = true" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-full focus:outline-none focus:ring-2 focus:ring-[#2596be] focus:ring-opacity-50 transition duration-300">
            <i class="fas fa-bell text-xl"></i>
            <span id="notification-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden shadow-md">0</span>
          </button>
        </div>
      @endauth
      <a href="/cart" class="relative group p-2 hover:bg-gray-50 rounded-full transition duration-300">
        <i class="fa-solid fa-bag-shopping text-xl group-hover:text-[#2596be] transition"></i>
        @if($cartCount > 0)
        <span class="absolute -top-1 -right-1 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-md transform scale-100 group-hover:scale-110 transition-transform cart-count">{{ $cartCount }}</span>
        @endif
      </a>
      @auth
        <div class="relative group">
          <button class="flex items-center p-2 hover:bg-gray-50 rounded-full focus:outline-none focus:ring-2 focus:ring-[#2596be] focus:ring-opacity-50 transition duration-300">
            <i class="fa-regular fa-user text-xl group-hover:text-[#2596be] transition"></i>
          </button>
          <div class="absolute right-0 mt-2 w-56 bg-white text-gray-700 shadow-xl rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300 divide-y divide-gray-100 z-20 transform origin-top-right">
            <a href="{{ route('account') }}" class="block px-4 py-3 hover:bg-gray-50 transition text-sm font-medium">Account Setting</a>
            <a href="{{ route('my-orders') }}" class="block px-4 py-3 hover:bg-gray-50 transition text-sm font-medium">My Orders</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-3 hover:bg-gray-50 transition text-sm font-medium text-red-600">Logout</button>
            </form>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="group p-2 hover:bg-gray-50 rounded-full transition duration-300">
          <i class="fa-regular fa-user text-xl group-hover:text-[#2596be] transition"></i>
        </a>
      @endauth
    </div>
  </div>
</header>

<!-- Navbar -->
<nav class="bg-[#1a2233] text-white shadow-lg">
  <div class="container mx-auto px-4 flex items-center justify-between h-16 md:h-20">
    <!-- Categories Dropdown -->
    <div class="relative group flex-shrink-0">
      <button class="flex items-center px-5 py-2.5 bg-[#2596be] hover:bg-[#217ca6] rounded-lg font-medium transition duration-300 shadow-md text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-[#2596be] focus:ring-opacity-50">
        <i class="fa-solid fa-bars mr-2"></i> All Categories
      </button>
      <div class="absolute top-full left-0 mt-2 w-64 md:w-72 bg-white text-gray-700 shadow-xl rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300 divide-y divide-gray-100 z-20 transform origin-top-left">
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
        <a href="{{ route('shop', ['category' => $category->id]) }}" class="flex items-center px-6 py-4 hover:bg-gray-50 transition duration-300 text-sm border-b border-gray-100 last:border-b-0 group/item">
          <i class="fa-solid fa-{{ $icons[$category->name] ?? 'tag' }} w-5 h-5 mr-4 text-[#2596be] group-hover/item:scale-110 transition-transform"></i>
          <span class="font-medium group-hover/item:text-[#2596be] transition-colors">{{ $category->name }}</span>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex items-center space-x-8 ml-8">
      <a href="/" class="{{ request()->is('/') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition duration-300 font-semibold text-sm md:text-base relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-[#2596be] hover:after:w-full after:transition-all">Home</a>
      <a href="/shop" class="{{ request()->is('shop*') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition duration-300 font-semibold text-sm md:text-base relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-[#2596be] hover:after:w-full after:transition-all">Shop</a>
      @guest
        <a href="{{ route('login') }}" class="{{ request()->is('login*') ? 'text-[#2596be]' : 'hover:text-[#2596be]' }} transition duration-300 font-semibold text-sm md:text-base relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-[#2596be] hover:after:w-full after:transition-all">Login</a>
      @endguest
    </div>
  </div>
</nav>

@push('scripts')
<script>
    // Keep updateNotifications for the badge
    function updateNotifications() {
        fetch('/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notification-badge');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('hidden');
                    badge.classList.add('animate-bounce');
                } else {
                    badge.classList.add('hidden');
                    badge.classList.remove('animate-bounce');
                }
            });
    }

    // This function loads notifications into the modal
    function loadNotificationsModal() {
        const container = document.getElementById('notification-modal-list');
        // Show loading state while fetching
        container.innerHTML = `
            <div class="px-4 py-4 text-center text-gray-500">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#2596be] mx-auto mb-2"></div>
                Loading notifications...
            </div>
        `;

        fetch('/notifications/recent')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.notifications.length === 0) {
                    container.innerHTML = `
                        <div class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-bell-slash text-4xl mb-3 text-gray-300"></i>
                            <p>No notifications yet.</p>
                        </div>
                    `;
                    return;
                }

                container.innerHTML = data.notifications.map(notification => `
                    <a href="${notification.link}" class="block px-4 py-4 hover:bg-gray-50 ${notification.is_read ? '' : 'bg-blue-50'} transition-colors duration-300 border-b border-gray-100 last:border-b-0">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1 text-lg">
                                <i class="fas ${getNotificationIcon(notification.type)} ${notification.is_read ? 'text-gray-400' : 'text-[#2596be]'}"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium ${notification.is_read ? 'text-gray-700' : 'text-gray-900'}">${notification.title}</p>
                                <p class="text-xs ${notification.is_read ? 'text-gray-500' : 'text-gray-600'} mt-1">${notification.message}</p>
                                <p class="text-xs text-gray-400 mt-2">${notification.created_at}</p>
                            </div>
                        </div>
                    </a>
                `).join('');
            }).catch(error => {
                console.error('Error loading notifications:', error);
                container.innerHTML = `
                    <div class="px-4 py-8 text-center text-red-500">
                        <i class="fas fa-exclamation-circle text-4xl mb-3"></i>
                        <p>Failed to load notifications.</p>
                        <p class="text-sm mt-2">${error}</p>
                    </div>
                `;
            });
    }

    function getNotificationIcon(type) {
        switch(type) {
            case 'order_status':
                return 'fa-shopping-bag';
            case 'new_product':
                return 'fa-box';
            case 'discount':
                return 'fa-tag';
            case 'admin_notification':
                return 'fa-bell';
            default:
                return 'fa-bell';
        }
    }

    // Update notification count every minute
    setInterval(updateNotifications, 60000);
    
    // Initial load of count
    updateNotifications();
</script>
@endpush
