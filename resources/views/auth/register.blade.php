<x-guest-layout>
    <div class="text-center mb-8 animate-[fadeInDown_0.5s_ease-out]">
        <h2 class="text-3xl font-extrabold text-white mb-2">Create Account</h2>
        <p class="text-slate-400 text-sm">Join the community and start tracking your fitness</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.1s_both]">
            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Full Name') }}</label>
            <input id="name" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Profession -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.15s_both]">
            <label for="profession" class="block text-sm font-medium text-slate-300 mb-2">Profession</label>
            <select id="profession" name="profession" required class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300 appearance-none">
                <option value="User">General User</option>
                <option value="Doctor">Doctor</option>
                <option value="Fitness Trainer">Fitness Trainer</option>
                <option value="Dietitian">Dietitian</option>
            </select>
            <x-input-error :messages="$errors->get('profession')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.2s_both]">
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
            <input id="email" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.3s_both]">
            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
            <input id="password" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="animate-[fadeInUp_0.5s_ease-out_0.4s_both]">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Health Profile Fields Section -->
        <div class="pt-4 pb-2 border-t border-slate-700/50 mt-4 animate-[fadeInUp_0.5s_ease-out_0.5s_both]">
            <h3 class="text-sm font-semibold text-[#4CAF50] mb-4 uppercase tracking-wider">Health Profile Details</h3>
            
            <div class="grid grid-cols-2 gap-4">
                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-slate-300 mb-2">Date of Birth</label>
                    <input id="date_of_birth" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300 [color-scheme:dark]" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Blood Group -->
                <div>
                    <label for="blood_group" class="block text-sm font-medium text-slate-300 mb-2">Blood Group</label>
                    <select id="blood_group" name="blood_group" required class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300 appearance-none">
                        <option value="">Select</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                    <x-input-error :messages="$errors->get('blood_group')" class="mt-2 text-red-400 text-sm" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <!-- Height -->
                <div>
                    <label for="height" class="block text-sm font-medium text-slate-300 mb-2">Height (cm)</label>
                    <input id="height" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300" type="number" step="0.1" name="height" :value="old('height')" required placeholder="175" />
                    <x-input-error :messages="$errors->get('height')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Weight -->
                <div>
                    <label for="weight" class="block text-sm font-medium text-slate-300 mb-2">Weight (kg)</label>
                    <input id="weight" class="block w-full px-4 py-3 bg-[#0f172a]/80 border border-slate-600 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:border-transparent hover:border-slate-500 shadow-sm focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300" type="number" step="0.1" name="weight" :value="old('weight')" required placeholder="70" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2 text-red-400 text-sm" />
                </div>
            </div>
        </div>

        <div class="pt-2 animate-[fadeInUp_0.5s_ease-out_0.6s_both]">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-[0_0_15px_rgba(76,175,80,0.3)] text-sm font-bold text-white bg-gradient-to-r from-[#4CAF50] to-[#2196F3] hover:from-[#45a049] hover:to-[#1e88e5] hover:shadow-[0_0_25px_rgba(76,175,80,0.5)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50] focus:ring-offset-[#0f172a] transform transition-all duration-300 hover:scale-[1.02]">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center mt-6 animate-[fadeInUp_0.5s_ease-out_0.7s_both]">
            <p class="text-sm text-slate-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-semibold text-[#4CAF50] hover:text-[#8BC34A] transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-[#4CAF50] after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100">Sign in</a>
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
