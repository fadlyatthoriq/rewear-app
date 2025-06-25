@extends('layouts.master')

@section('title', 'Account Settings')

@section('main')
<section class="bg-white py-12 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Account Settings</h2>
            <p class="mt-3 text-base text-gray-500 dark:text-gray-400">Manage your account information and preferences</p>
        </div>

        <div class="space-y-8">
            <!-- Profile Information Card -->
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
                <h3 class="mb-6 text-xl font-bold text-gray-900 dark:text-white">Profile Information</h3>
                <form action="{{ route('account.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Profile Picture Section -->
                    <div class="flex flex-col sm:flex-row items-center gap-6 mb-6">
                        <div class="relative">
                            <img src="{{ auth()->user()->profile_picture ? auth()->user()->profile_picture : asset('images/default-avatar.png') }}" 
                                 alt="Profile Picture" 
                                 class="w-32 h-32 rounded-full object-cover ring-4 ring-gray-100 dark:ring-gray-700">
                        </div>
                        <div class="flex-1">
                            <input type="file" 
                                   name="profile_picture" 
                                   accept="image/*" 
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600 transition-colors">
                            <p class="mt-2 text-sm text-gray-500">Upload a new profile picture (Max 2MB)</p>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', auth()->user()->name) }}" 
                                   required
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', auth()->user()->email) }}" 
                                   required 
                                   disabled
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone" 
                                   value="{{ old('phone', auth()->user()->phone) }}"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                            @if(auth()->user()->phone)
                                <div class="mt-2">
                                    <a href="{{ \App\Helpers\WhatsAppHelper::generateWhatsAppUrl(auth()->user()->phone, 'Halo, saya ingin bertanya tentang produk di Rewear App.') }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                        </svg>
                                        Test WhatsApp
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="3"
                                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">{{ old('address', auth()->user()->address) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="text-white !bg-primary-600 hover:!bg-primary-600 focus:ring-4 focus:!ring-primary-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:!bg-primary-600 dark:hover:!bg-primary-700 focus:outline-none dark:focus:!ring-primary-800 transition-colors">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Seller Information Card -->
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
                <h3 class="mb-6 text-xl font-bold text-gray-900 dark:text-white">Seller Information</h3>
                <form action="{{ route('account.updateSellerInfo') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="store_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Store Name</label>
                            <input type="text" 
                                   name="store_name" 
                                   id="store_name" 
                                   value="{{ old('store_name', auth()->user()->store_name) }}"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                        </div>

                        <div class="md:col-span-2">
                            <label for="store_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Store Description</label>
                            <textarea name="store_description" 
                                      id="store_description" 
                                      rows="3"
                                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">{{ old('store_description', auth()->user()->store_description) }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_seller" 
                               id="is_seller" 
                               value="1" 
                               {{ auth()->user()->is_seller ? 'checked disabled' : '' }}
                               class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                        <label for="is_seller" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I want to sell products</label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="text-white !bg-primary-600 hover:!bg-primary-600 focus:ring-4 focus:!ring-primary-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:!bg-primary-600 dark:hover:!bg-primary-700 focus:outline-none dark:focus:!ring-primary-800 transition-colors">
                            Update Seller Information
                        </button>
                    </div>
                </form>
            </div>

            <!-- My Products Section -->
            {{-- @if(auth()->user()->is_seller)
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">My Products</h3>
                    <a href="{{ route('products.create') }}" 
                       class="text-white bg-primary hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 transition-colors">
                        Add New Product
                    </a>
                </div>

                <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4 md:gap-6">
                    @foreach(auth()->user()->products as $product)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <img src="{{ $product->image }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h4>
                            <p class="text-primary-600 font-medium text-lg mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Stock: {{ $product->stock }}</p>
                                <p class="text-sm">
                                    Status: 
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                        @if($product->status === 'active') bg-green-100 text-green-800
                                        @elseif($product->status === 'inactive') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Condition: {{ ucfirst($product->condition) }}</p>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="flex-1 text-center text-white !bg-primary-600 hover:!bg-primary-600 focus:ring-4 focus:!ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:!bg-primary-600 dark:hover:!bg-primary-700 focus:outline-none dark:focus:!ring-primary-800 transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition-colors" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif --}}

            <!-- Change Password Card -->
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
                <h3 class="mb-6 text-xl font-bold text-gray-900 dark:text-white">Change Password</h3>
                <form action="{{ route('account.password') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="current_password" 
                                       id="current_password" 
                                       required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                                        onclick="togglePassword('current_password')">
                                    <svg class="h-5 w-5" id="current_password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                                        onclick="togglePassword('password')">
                                    <svg class="h-5 w-5" id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-500">
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                                        onclick="togglePassword('password_confirmation')">
                                    <svg class="h-5 w-5" id="password_confirmation-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="text-white !bg-primary-600 hover:!bg-primary-600 focus:ring-4 focus:!ring-primary-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:!bg-primary-600 dark:hover:!bg-primary-700 focus:outline-none dark:focus:!ring-primary-800 transition-colors">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>
@endpush
@endsection