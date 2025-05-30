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
                            created_at: notification.created_at // Assuming Carbon diffForHumans is done server-side or handle here if needed
                         }));
                     }
                 }).catch(error => {
                     console.error('Error loading notifications:', error);
                     this.loading = false;
                     // Optionally set an error state here
                 });
         }
     }"
     x-init="$watch('openNotificationModal', value => {
         if (value) {
             fetchNotifications();
         }
     })"
     class="fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0"
     @click.away="openNotificationModal = false"
     @keydown.escape.window="openNotificationModal = false">
    
    <!-- Modal dialog -->
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         @click.stop>

        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-gray-50 to-white">
            <h3 class="text-xl font-bold text-gray-900">Notifications</h3>
            <button @click="openNotificationModal = false" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div id="notification-modal-list-container" class="max-h-[60vh] overflow-y-auto divide-y divide-gray-100">
            <!-- Loading state -->
            <div x-show="loading" class="px-6 py-8 text-center">
                <div class="mx-auto w-16 h-16 text-gray-300 mb-4">
                    <i class="fas fa-spinner fa-spin text-4xl"></i>
                </div>
                <p class="text-gray-500">Loading notifications...</p>
            </div>
            
            <!-- Empty state -->
            <div x-show="empty" class="px-6 py-8 text-center">
                <div class="mx-auto w-16 h-16 text-gray-300 mb-4">
                    <i class="fas fa-bell-slash text-4xl"></i>
                </div>
                <p class="text-gray-500">No notifications yet.</p>
            </div>

            <!-- Notifications list -->
            <div x-show="notifications.length > 0">
                <template x-for="notification in notifications" :key="notification.id">
                    <a :href="notification.link" 
                       class="block px-6 py-4 hover:bg-gray-50" 
                       :class="notification.is_read ? '' : 'bg-blue-50'">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" 
                                     :class="notification.is_read ? 'bg-gray-100' : 'bg-[#2596be] bg-opacity-10'">
                                    <i class="fas text-lg" 
                                       :class="[getNotificationIcon(notification.type), notification.is_read ? 'text-gray-400' : 'text-[#2596be]']"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-sm font-semibold" 
                                        :class="notification.is_read ? 'text-gray-700' : 'text-gray-900'">
                                        <span x-text="notification.title"></span>
                                    </h4>
                                    <span class="ml-4 flex-shrink-0 text-xs text-gray-500" x-text="notification.created_at"></span>
                                </div>
                                <p class="mt-1 text-sm" :class="notification.is_read ? 'text-gray-500' : 'text-gray-600'" x-text="notification.message"></p>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center">
            <a href="{{ route('notifications.index') }}" 
               class="inline-flex items-center text-sm font-medium text-[#2596be] hover:text-[#1f7a9a] transition-colors duration-200">
                View all notifications
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div> 

<script>
    // Moved getNotificationIcon function here as it's used within the modal component
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
</script> 