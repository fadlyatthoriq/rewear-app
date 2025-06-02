<!-- Notification Modal (Alpine.js) -->
<div x-show="openNotificationModal" 
     x-cloak
     x-data="{ 
         notifications: [],
         loading: false,
         empty: false,
         fetchNotifications() {
             this.loading = true;
             this.empty = false;
             this.notifications = [];
             fetch('/notifications/recent')
                 .then(response => {
                     if (!response.ok) {
                         throw new Error(`HTTP error! status: ${response.status}`);
                     }
                     return response.json();
                 })
                 .then(data => {
                     this.loading = false;
                     if (data.notifications.length === 0) {
                         this.empty = true;
                     } else {
                         this.notifications = data.notifications.map(notification => ({
                            id: notification.id,
                            type: notification.type,
                            title: notification.title,
                            message: notification.message,
                            link: notification.link,
                            is_read: notification.is_read,
                            created_at: notification.created_at
                         }));
                     }
                 }).catch(error => {
                     console.error('Error loading notifications:', error);
                     this.loading = false;
                 });
         }
     }"
     x-init="$watch('openNotificationModal', value => {
         if (value) {
             fetchNotifications();
         }
     })"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0"
     @click.away="openNotificationModal = false"
     @keydown.escape.window="openNotificationModal = false">
    
    <!-- Modal dialog -->
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-auto transform transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         @click.stop>

        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-gray-50 to-white rounded-t-2xl">
            <div class="flex items-center space-x-3">
                <h3 class="text-xl font-bold text-gray-900">Notifications</h3>
                <span x-show="notifications.length > 0" 
                      class="px-2.5 py-0.5 text-xs font-medium bg-[#2596be] text-white rounded-full"
                      x-text="notifications.length + ' new'">
                </span>
            </div>
            <button @click="openNotificationModal = false" 
                    class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#2596be] focus:ring-offset-2 rounded-full p-1 transition-all duration-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Content -->
        <div id="notification-modal-list-container" class="max-h-[60vh] overflow-y-auto divide-y divide-gray-100 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent">
            <!-- Loading state -->
            <div x-show="loading" class="px-6 py-12 text-center">
                <div class="mx-auto w-16 h-16 text-[#2596be] mb-4 animate-spin">
                    <i class="fas fa-circle-notch text-4xl"></i>
                </div>
                <p class="text-gray-600 font-medium">Loading notifications...</p>
            </div>
            
            <!-- Empty state -->
            <div x-show="empty" class="px-6 py-12 text-center">
                <div class="mx-auto w-16 h-16 text-gray-300 mb-4">
                    <i class="fas fa-bell-slash text-4xl"></i>
                </div>
                <p class="text-gray-600 font-medium">No notifications yet</p>
                <p class="text-gray-500 text-sm mt-1">We'll notify you when something arrives</p>
            </div>

            <!-- Notifications list -->
            <div x-show="notifications.length > 0" class="divide-y divide-gray-100">
                <template x-for="notification in notifications" :key="notification.id">
                    <a :href="notification.link" 
                       class="block px-6 py-4 hover:bg-gray-50 transition-colors duration-200" 
                       :class="notification.is_read ? '' : 'bg-blue-50'">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-200" 
                                     :class="notification.is_read ? 'bg-gray-100' : 'bg-[#2596be] bg-opacity-10'">
                                    <i class="fas text-lg" 
                                       :class="[getNotificationIcon(notification.type), notification.is_read ? 'text-gray-400' : 'text-[#2596be]']"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-sm font-semibold line-clamp-1" 
                                        :class="notification.is_read ? 'text-gray-700' : 'text-gray-900'">
                                        <span x-text="notification.title"></span>
                                    </h4>
                                    <span class="ml-4 flex-shrink-0 text-xs text-gray-500 whitespace-nowrap" x-text="notification.created_at"></span>
                                </div>
                                <p class="mt-1 text-sm line-clamp-2" 
                                   :class="notification.is_read ? 'text-gray-500' : 'text-gray-600'" 
                                   x-text="notification.message"></p>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center rounded-b-2xl">
            <a href="{{ route('notifications.index') }}" 
               class="inline-flex items-center text-sm font-medium text-[#2596be] hover:text-[#1f7a9a] transition-colors duration-200 group">
                View all notifications
                <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
            </a>
        </div>
    </div>
</div> 

<script>
    function getNotificationIcon(type) {
        const icons = {
            order_status: 'fa-shopping-bag',
            new_product: 'fa-box',
            discount: 'fa-tag',
            admin_notification: 'fa-bell',
            default: 'fa-bell'
        };
        return icons[type] || icons.default;
    }
</script> 