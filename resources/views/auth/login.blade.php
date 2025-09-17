@vite('resources/css/app.css')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - Voting System</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-cream min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full space-y-8 px-4 py-8">
        <!-- Top info / icon -->
        <div class="text-center">
            <i class="fas fa-vote-yea text-6xl text-primary-green mb-4"></i>
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('Sign in to vote') }}</h2>
            <p class="mt-2 text-sm text-gray-600">{{ __('Your voice matters. Cast your vote securely.') }}</p>
        </div>

        <!-- Session status -->
        @if (session('status'))
            <div class="rounded-md bg-green-50 p-4 border border-green-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-green-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Card -->
        <div class="voting-card rounded-xl shadow-xl p-8">
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-primary-green"></i>{{ __('Email Address') }}
                    </label>
                    <input id="email" name="email" type="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent transition-all"
                        placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}" autocomplete="username"
                        autofocus>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-primary-green"></i>{{ __('Password') }}
                    </label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent transition-all"
                        placeholder="{{ __('Enter your password') }}" autocomplete="current-password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary-green focus:ring-primary-green border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}"
                                class="font-medium text-primary-green hover:underline">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit"
                        class="btn-primary w-full flex items-center justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-green">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Sign in to Vote') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center">
            <div class="bg-light-green rounded-lg p-4 inline-flex items-center">
                <i class="fas fa-shield-alt text-primary-green mr-2"></i>
                <span class="text-sm text-gray-700">{{ __('Your vote is secure and anonymous') }}</span>
            </div>
        </div>
    </div>

</body>

</html>
