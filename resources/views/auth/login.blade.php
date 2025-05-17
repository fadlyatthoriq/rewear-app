<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- Styles -->
    @vite('public/assets-admin/src/style.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    
</head>

<body class="bg-gradient-to-br from-primary-50 to-primary-100 font-sans">
    <!-- Back Button -->
    <a href="{{ url('/') }}" class="fixed top-4 left-4 sm:top-6 sm:left-6 inline-flex items-center px-2 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg sm:rounded-xl shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="hidden sm:inline">Back to Home</span>
        <span class="sm:hidden">Back</span>
    </a>

    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <a href="{{ url('/') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold text-gray-900 hover:opacity-80 transition-opacity">
            <img src="{{ asset('assets/images/logo.png') }}" class="h-10 mr-3" alt="Logo">
        </a>
        
        <!-- Card -->
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl backdrop-blur-sm bg-opacity-90">
            <h2 class="text-3xl font-bold text-center text-gray-900">
                Welcome Back
            </h2>
            <p class="text-center text-gray-600">Please sign in to your account</p>

        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" name="email" id="email" 
                    class="mt-1 block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-500 @enderror" 
                    value="{{ old('email') }}"
                    placeholder="name@company.com" required autofocus>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" 
                        class="mt-1 block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('password') border-red-500 @enderror" 
                        placeholder="••••••••" required>
                    <button type="button" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                        onclick="togglePassword('password')">
                        <svg class="h-5 w-5" id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>
            
            <button type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                Sign in
            </button>
            
            <div class="text-center text-sm">
                <span class="text-gray-600">Don't have an account?</span>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500 ml-1 transition-colors">
                        Sign up
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

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

<!-- SweetAlert -->
@include('sweetalert::alert')
</body>

</html>