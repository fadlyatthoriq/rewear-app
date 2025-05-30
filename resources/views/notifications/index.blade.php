@extends('layouts.master')

@section('title', 'Notifications')

@section('main')
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-2xl font-bold text-gray-900">Notifications</h2>
                @if($notifications->isNotEmpty())
                    <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#2596be] rounded-lg hover:bg-[#1f7a9a] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2596be]">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($notifications as $notification)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200 {{ $notification->is_read ? '' : 'bg-blue-50' }}">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                @php
                                    $iconClass = 'fas fa-bell';
                                    if ($notification->type === 'order_status') $iconClass = 'fas fa-shopping-bag';
                                    if ($notification->type === 'new_product') $iconClass = 'fas fa-box';
                                    if ($notification->type === 'discount') $iconClass = 'fas fa-tag';
                                @endphp
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $notification->is_read ? 'bg-gray-100' : 'bg-[#2596be] bg-opacity-10' }}">
                                    <i class="{{ $iconClass }} text-lg {{ $notification->is_read ? 'text-gray-400' : 'text-[#2596be]' }}"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-base font-semibold {{ $notification->is_read ? 'text-gray-700' : 'text-gray-900' }}">{{ $notification->title }}</h3>
                                    <span class="ml-4 flex-shrink-0 text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-1 text-sm {{ $notification->is_read ? 'text-gray-500' : 'text-gray-600' }}">{{ $notification->message }}</p>
                                
                                <div class="mt-3 flex items-center space-x-4">
                                    @if(!$notification->is_read)
                                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-sm font-medium text-[#2596be] hover:text-[#1f7a9a] focus:outline-none focus:underline transition-colors duration-200">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                    @if($notification->link)
                                        <a href="{{ 
                                            Str::startsWith($notification->link, ['http://', 'https://']) 
                                                ? $notification->link 
                                                : 'http://localhost:8000' . $notification->link 
                                        }}" 
                                           class="text-sm font-medium text-[#2596be] hover:text-[#1f7a9a] focus:outline-none focus:underline transition-colors duration-200">
                                            View Details
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="mx-auto w-24 h-24 text-gray-300 mb-4">
                            <i class="fas fa-bell-slash text-6xl"></i>
                        </div>
                        <p class="text-gray-500 text-lg">No notifications found.</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $notifications->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 