<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-[#4CAF50] font-medium" :status="session('status')" />

    <div class="text-center mb-8 animate-[fadeInDown_0.5s_ease-out]">
        <h2 class="text-3xl font-extrabold text-white mb-2">Welcome Back</h2>
        <p class="text-slate-400 text-sm">Sign in to continue your fitness journey</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.1s_both]">
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
            <input id="email" class="block w-full px-4 py-3 bg-[#0f172a]/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent transition-all duration-300 hover:border-slate-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.2s_both]">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-slate-300">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-[#4CAF50] hover:text-[#8BC34A] transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <input id="password" class="block w-full px-4 py-3 bg-[#0f172a]/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent transition-all duration-300 hover:border-slate-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center animate-[fadeInUp_0.5s_ease-out_0.3s_both]">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded bg-[#0f172a]/50 border-slate-700 text-[#4CAF50] focus:ring-[#4CAF50] focus:ring-offset-0 transition duration-200 cursor-pointer" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-slate-400 cursor-pointer select-none hover:text-slate-300 transition-colors">
                {{ __('Remember me for 30 days') }}
            </label>
        </div>

        <div class="animate-[fadeInUp_0.5s_ease-out_0.4s_both]">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-[0_0_15px_rgba(76,175,80,0.3)] text-sm font-bold text-white bg-gradient-to-r from-[#4CAF50] to-[#2196F3] hover:from-[#45a049] hover:to-[#1e88e5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50] focus:ring-offset-[#0f172a] transform transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_0_25px_rgba(76,175,80,0.5)]">
                {{ __('Sign In') }}
            </button>
        </div>
        
        <div class="text-center mt-6 animate-[fadeInUp_0.5s_ease-out_0.5s_both]">
            <p class="text-sm text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-semibold text-[#4CAF50] hover:text-[#8BC34A] transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-[#4CAF50] after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100">Sign up</a>
            </p>
        </div>
    </form>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-guest-layout>
