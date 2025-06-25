@extends('layouts.master')
@section('title', 'Update Order Item')
@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-sm px-4 2xl:px-0">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Update Order Item</h2>
            <form method="POST" action="{{ route('seller.order-items.update', $item->id) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="shipping_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="shipping_status" id="shipping_status" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent dark:bg-gray-900 dark:text-white">
                        <option value="pending" @selected($item->shipping_status=='pending')>Pending</option>
                        <option value="processing" @selected($item->shipping_status=='processing')>Processing</option>
                        <option value="shipped" @selected($item->shipping_status=='shipped')>Shipped</option>
                        <option value="delivered" @selected($item->shipping_status=='delivered')>Delivered</option>
                    </select>
                </div>
                <div>
                    <label for="tracking_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tracking Number <span class="text-red-500">*</span></label>
                    <input type="text" name="tracking_number" id="tracking_number" value="{{ old('tracking_number', $item->tracking_number) }}"
                        @if(old('shipping_status', $item->shipping_status)=='shipped') required @endif
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent dark:bg-gray-900 dark:text-white"
                        placeholder="Masukkan nomor resi (wajib jika status shipped)">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Wajib diisi jika status <b>shipped</b></p>
                    @error('tracking_number')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('seller.order-items.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#2596be] text-white rounded-lg hover:bg-[#217ca6] transition-colors duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection 