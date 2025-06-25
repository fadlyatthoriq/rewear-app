{{-- Navbar --}}
<nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 transition-all duration-300">
    <div class="px-4 py-3 lg:px-6 lg:pl-4">
        <div class="flex items-center justify-between">
            {{-- Left Section: Logo and Mobile Menu --}}
            <div class="flex items-center justify-start space-x-4">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" 
                    class="p-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white transition-all duration-200">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logo.png') }}" class="h-8 w-auto" alt="Rewear Logo" />
                </a>
            </div>

            {{-- Right Section: Search, Theme Toggle, Notifications, Profile --}}
            <div class="flex items-center space-x-4">
                <!-- Search mobile -->
                <button id="toggleSidebarMobileSearch" type="button" class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Search</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </button>
                <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
                <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Toggle dark mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                <!-- Notifications -->
                <div class="flex items-center">
                    <button id="notificationButton" data-dropdown-toggle="notificationDropdown" 
                        class="relative p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 transition-all duration-200">
                        <span class="sr-only">View notifications</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                        </svg>
                        <span id="notificationBadge" class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full hidden"></span>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="notificationDropdown" class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600" style="min-width: 20rem;">
                        <div class="block px-4 py-3 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-white border-b border-gray-200 dark:border-gray-600">
                            <div class="flex items-center justify-between">
                                <span>Notifications</span>
                                <button onclick="markAllAsRead()" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    Mark all as read
                                </button>
                            </div>
                        </div>
                        <div id="notificationList" class="max-h-96 overflow-y-auto">
                            <!-- Notifications will be loaded here -->
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <p>Loading notifications...</p>
                            </div>
                        </div>
                        <div class="block px-4 py-3 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-white border-t border-gray-200 dark:border-gray-600">
                            <a href="{{ route('admin.notifications.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-500">View all notifications</a>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                @auth
                <div class="flex items-center">
                    <div>
                        <button type="button" 
                            class="flex items-center text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 transition-all duration-200 hover:ring-2 hover:ring-gray-300 dark:hover:ring-gray-600" 
                            id="user-menu-button-2" 
                            aria-expanded="false" 
                            data-dropdown-toggle="dropdown-2">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full object-cover" 
                                src="{{ auth()->user()->profile_picture ? auth()->user()->profile_picture : asset('assets-admin/static/images/avatar-default.svg') }}" 
                                alt="{{ auth()->user()->name }}" 
                                onerror="this.onerror=null; this.src='{{ asset('assets-admin/static/images/avatar-default.svg') }}'">
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="dropdown-2">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 dark:text-white" role="none">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400" role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Theme toggle functionality with smooth transition
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');
    const html = document.documentElement;

    // Add transition class to body
    document.body.classList.add('transition-colors', 'duration-300');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
        html.classList.add('dark');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
        html.classList.remove('dark');
    }

    themeToggleBtn.addEventListener('click', function() {
        // Toggle icons with animation
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // If is set to local storage
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                html.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        } else {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });

    // Notification functionality with improved UX
    function updateNotificationBadge() {
        fetch(window.location.origin + '/admin/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notificationBadge');
                if (data.count > 0) {
                    badge.textContent = data.count > 99 ? '99+' : data.count;
                    badge.classList.remove('hidden');
                    badge.classList.add('animate-bounce');
                    setTimeout(() => badge.classList.remove('animate-bounce'), 1000);
                } else {
                    badge.classList.add('hidden');
                }
            })
            .catch(error => console.error('Error fetching notification count:', error));
    }

    function loadNotifications() {
        const notificationList = document.getElementById('notificationList');
        notificationList.innerHTML = `
            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                <svg class="w-8 h-8 mx-auto mb-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <p>Loading notifications...</p>
            </div>
        `;

        fetch(window.location.origin + '/admin/notifications/recent')
            .then(response => response.json())
            .then(data => {
                notificationList.innerHTML = '';

                if (data.notifications.length === 0) {
                    notificationList.innerHTML = `
                        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p>No notifications</p>
                        </div>
                    `;
                    return;
                }

                data.notifications.forEach(notification => {
                    const notificationElement = document.createElement('div');
                    notificationElement.className = `p-4 border-b border-gray-200 dark:border-gray-600 ${notification.is_read ? 'bg-white dark:bg-gray-700' : 'bg-gray-50 dark:bg-gray-800'} transition-colors duration-200`;
                    notificationElement.innerHTML = `
                        <div class="flex items-start">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">${notification.title}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">${notification.message}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">${notification.created_at}</p>
                            </div>
                            ${!notification.is_read ? `
                                <button onclick="markAsRead(${notification.id})" 
                                    class="ml-2 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                    Mark as read
                                </button>
                            ` : ''}
                        </div>
                    `;
                    notificationList.appendChild(notificationElement);
                });
            })
            .catch(error => {
                notificationList.innerHTML = `
                    <div class="p-4 text-center text-red-500 dark:text-red-400">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Error loading notifications</p>
                    </div>
                `;
                console.error('Error loading notifications:', error);
            });
    }

    function markAsRead(notificationId) {
        const button = event.target;
        button.disabled = true;
        button.innerHTML = `
            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        `;

        fetch(window.location.origin + `/admin/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => {
            updateNotificationBadge();
            loadNotifications();
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
            button.disabled = false;
            button.textContent = 'Mark as read';
        });
    }

    function markAllAsRead() {
        const button = event.target;
        button.disabled = true;
        button.innerHTML = `
            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        `;

        fetch(window.location.origin + '/admin/notifications/mark-all-as-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => {
            updateNotificationBadge();
            loadNotifications();
        })
        .catch(error => {
            console.error('Error marking all notifications as read:', error);
            button.disabled = false;
            button.textContent = 'Mark all as read';
        });
    }

    // Initial load
    updateNotificationBadge();
    loadNotifications();

    // Refresh notifications every 30 seconds
    setInterval(() => {
        updateNotificationBadge();
        loadNotifications();
    }, 30000);

    // Load notifications when dropdown is opened
    document.getElementById('notificationButton').addEventListener('click', () => {
        loadNotifications();
    });

    // Mobile menu toggle
    const toggleSidebarMobile = document.getElementById('toggleSidebarMobile');
    const toggleSidebarMobileHamburger = document.getElementById('toggleSidebarMobileHamburger');
    const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');
    const sidebar = document.getElementById('sidebar');

    toggleSidebarMobile.addEventListener('click', () => {
        toggleSidebarMobileHamburger.classList.toggle('hidden');
        toggleSidebarMobileClose.classList.toggle('hidden');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
@endpush