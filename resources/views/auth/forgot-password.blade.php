<x-guest-layout>
    <div class="w-full max-w-lg bg-white/90 backdrop-blur-md rounded-xl shadow-xl p-8">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex text-center mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        <div class="text-center pt-2">
            <p class="text-sm text-gray-600">
                <a href="{{ route('login') }}" class="font-bold text-indigo-700 hover:text-indigo-500 transition">Login</a>
            </p>
        </div>
    </form>
</div>
</x-guest-layout>
