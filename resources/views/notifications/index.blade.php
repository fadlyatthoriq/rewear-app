@extends('layouts.master')

@section('title', 'Notifications')

@section('main')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header Section -->
                <div class="px-6 py-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center bg-gradient-to-r from-gray-50 to-white space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-bell text-2xl text-[#2596be]"></i>
                        <h2 class="text-2xl font-bold text-gray-900">Notifications</h2>
                    </div>
                    @if($notifications->isNotEmpty())
                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-white bg-[#2596be] rounded-lg hover:bg-[#1f7a9a] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2596be] shadow-sm hover:shadow-md">
                                <i class="fas fa-check-double mr-2"></i>Mark all as read
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Notifications List -->
                <div class="divide-y divide-gray-100">
                    @forelse($notifications as $notification)
                        <div class="p-6 hover:bg-gray-50 transition-all duration-200 {{ $notification->is_read ? '' : 'bg-blue-50' }}">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    @php
                                        $iconClass = 'fas fa-bell';
                                        if ($notification->type === 'order_status') $iconClass = 'fas fa-shopping-bag';
                                        if ($notification->type === 'new_product') $iconClass = 'fas fa-box';
                                        if ($notification->type === 'discount') $iconClass = 'fas fa-tag';
                                    @endphp
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $notification->is_read ? 'bg-gray-100' : 'bg-[#2596be] bg-opacity-10' }} transition-all duration-200">
                                        <i class="{{ $iconClass }} text-xl {{ $notification->is_read ? 'text-gray-400' : 'text-[#2596be]' }}"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start space-y-2 sm:space-y-0">
                                        <h3 class="text-base font-semibold {{ $notification->is_read ? 'text-gray-700' : 'text-gray-900' }}">{{ $notification->title }}</h3>
                                        <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-2 text-sm {{ $notification->is_read ? 'text-gray-500' : 'text-gray-600' }} leading-relaxed">{{ $notification->message }}</p>
                                    
                                    <div class="mt-4 flex flex-wrap items-center gap-4">
                                        @if(!$notification->is_read)
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#2596be] hover:text-[#1f7a9a] focus:outline-none focus:underline transition-colors duration-200">
                                                    <i class="fas fa-check mr-2"></i>Mark as read
                                                </button>
                                            </form>
                                        @endif
                                        @if($notification->link)
                                            <a href="{{ 
                                                Str::startsWith($notification->link, ['http://', 'https://']) 
                                                    ? $notification->link 
                                                    : 'http://localhost:8000' . $notification->link 
                                            }}" 
                                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#2596be] rounded-lg hover:bg-[#1f7a9a] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2596be] shadow-sm hover:shadow-md">
                                                <i class="fas fa-external-link-alt mr-2"></i>View Details
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="mx-auto w-24 h-24 text-gray-300 mb-6">
                                <i class="fas fa-bell-slash text-7xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">No notifications found</p>
                            <p class="text-gray-400 mt-2">We'll notify you when something new arrives</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($notifications->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $notifications->links('vendor.pagination.tailwind') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 