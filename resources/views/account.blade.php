@extends('layouts.master')

@section('title', 'Account Settings')

@section('main')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-8">
    <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Account Settings</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Manage your account information and preferences</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Account Information -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Account Information</h3>
                <form action="{{ route('account.update') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" readonly class="block w-full rounded-lg border border-gray-300 bg-gray-100 p-2.5 text-sm text-gray-500 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Email address cannot be changed for security reasons.</p>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea id="address" name="address" rows="3" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save Changes</button>
                </form>
            </div>

            <!-- Change Password -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Change Password</h3>
                <form action="{{ route('account.password') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                        <input type="password" id="password" name="password" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>
                    </div>

                    <button type="submit" class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection