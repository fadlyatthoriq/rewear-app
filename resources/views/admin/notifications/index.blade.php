@extends('layouts.admin-master')

@section('title', 'Notifications')

@section('content')
    {{-- Kontainer utama dengan padding agar tidak menempel pada sidebar --}}
    <div class="p-4">
        {{-- Kontainer dengan lebar maksimum dan terpusat --}}
        <div class="max-w-6xl mx-auto">

            {{-- Page Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Admin Notifications</h2>
                <button onclick="markAllAsRead()" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-800 transition">
                    Mark All as Reads
                </button>
            </div>

            {{-- Notifications List Card --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($notifications as $notification)
                        <div class="px-4 py-4 sm:px-6 {{ $notification->is_read ? 'text-gray-600 dark:text-gray-400' : 'bg-blue-50 dark:bg-blue-900 text-gray-900 dark:text-white font-medium' }} hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">
                                <div class="flex-1 pr-4">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-base font-semibold">{{ $notification->title }}</h3>
                                        @unless($notification->is_read)
                                            <span class="px-2 py-0.5 text-xs font-medium bg-blue-500 text-white dark:bg-blue-600 rounded-full">New</span>
                                        @endunless
                                    </div>
                                    <p class="text-sm leading-relaxed">{{ $notification->message }}</p>
                                    <div class="mt-2 flex items-center flex-wrap gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                        @if($notification->link)
                                            <span class="text-gray-400 dark:text-gray-500">•</span> {{-- Menggunakan bullet point sebagai pemisah --}}
                                            <a href="{{ $notification->link }}" class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300" target="_self">View Details →</a>
                                        @endif
                                    </div>
                                </div>
                                @unless($notification->is_read)
                                    <div class="flex-shrink-0">
                                        <button onclick="markAsRead({{ $notification->id }})" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline">
                                            Mark as read
                                        </button>
                                    </div>
                                @endunless
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 px-4 text-gray-500 dark:text-gray-400">
                            <svg class="mx-auto h-14 w-14 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h2l2-2V9A5 5 0 0017 4H7A5 5 0 002 9v6l2 2h2m2 4h6a2 2 0 002-2v-2H8v2a2 2 0 002 2zM9 18h6" />
                            </svg>
                            <h3 class="text-lg font-semibold">No notifications</h3>
                            <p class="text-sm mt-1">You don't have any notifications yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pagination Links --}}
            @if ($notifications->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $notifications->links('pagination::tailwind') }}
                </div>
            @endif

        </div> {{-- End max-w-6xl container --}}

    </div> {{-- End p-4 padding container --}}

@endsection

@push('scripts')
<script>
    // JavaScript functions for Mark as Read and Mark All as Read (remain)
    function markAsRead(notificationId) {
        fetch(`/admin/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => window.location.reload());
    }

    function markAllAsRead() {
        fetch('/admin/notifications/mark-all-as-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => window.location.reload());
    }

    // No initial load or dynamic rendering via JS needed anymore
</script>
@endpush
