@extends('layouts.admin-master')

@section('title', 'Notifications')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            {{-- Page Header with improved spacing and responsive design --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Admin Notifications</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage and view all your system notifications</p>
                </div>
                <button onclick="markAllAsRead()" 
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Mark All as Read
                </button>
            </div>

            {{-- Notifications List Card with improved styling --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($notifications as $notification)
                        <div class="px-4 py-5 sm:px-6 {{ $notification->is_read ? 'text-gray-600 dark:text-gray-400' : 'bg-blue-50 dark:bg-blue-900/30 text-gray-900 dark:text-white font-medium' }} hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 ease-in-out">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                                <div class="flex-1 space-y-3">
                                    <div class="flex items-center gap-3">
                                        <h3 class="text-lg font-semibold leading-tight">{{ $notification->title }}</h3>
                                        @unless($notification->is_read)
                                            <span class="px-2.5 py-1 text-xs font-medium bg-blue-500 text-white dark:bg-blue-600 rounded-full animate-pulse">New</span>
                                        @endunless
                                    </div>
                                    <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ $notification->message }}</p>
                                    <div class="flex items-center flex-wrap gap-3 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                        @if($notification->link)
                                            <span class="text-gray-400 dark:text-gray-500">•</span>
                                            <a href="{{ $notification->link }}" 
                                               class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline transition-colors duration-200">
                                                View Details
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @unless($notification->is_read)
                                    <div class="flex-shrink-0">
                                        <button onclick="markAsRead({{ $notification->id }})" 
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Mark as read
                                        </button>
                                    </div>
                                @endunless
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 px-4">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                                <svg class="w-8 h-8 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h2l2-2V9A5 5 0 0017 4H7A5 5 0 002 9v6l2 2h2m2 4h6a2 2 0 002-2v-2H8v2a2 2 0 002 2zM9 18h6" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No notifications</h3>
                            <p class="text-gray-600 dark:text-gray-400">You don't have any notifications at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pagination with improved styling --}}
            @if ($notifications->hasPages())
                <div class="mt-8">
                    {{ $notifications->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function markAsRead(notificationId) {
        const button = event.currentTarget;
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');

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
            // Add fade-out animation
            const notification = button.closest('.notification-item');
            notification.style.transition = 'opacity 0.3s ease-out';
            notification.style.opacity = '0';
            
            setTimeout(() => {
                window.location.reload();
            }, 300);
        })
        .catch(error => {
            console.error('Error:', error);
            button.disabled = false;
            button.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    }

    function markAllAsRead() {
        const button = event.currentTarget;
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');

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
            // Add fade-out animation to all unread notifications
            document.querySelectorAll('.notification-item').forEach(item => {
                item.style.transition = 'opacity 0.3s ease-out';
                item.style.opacity = '0';
            });
            
            setTimeout(() => {
                window.location.reload();
            }, 300);
        })
        .catch(error => {
            console.error('Error:', error);
            button.disabled = false;
            button.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    }
</script>
@endpush
