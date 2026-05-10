<nav x-data="{ open: false, searchOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-40 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold text-white text-sm shadow-md group-hover:scale-110 transition-transform">
                            F
                        </div>
                        <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-[#4CAF50] transition-colors">Fit<span class="text-[#4CAF50]">Community</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Health Tracker') }}
                    </x-nav-link>
                    <x-nav-link :href="route('community.index')" :active="request()->routeIs('community.*')">
                        {{ __('Community') }}
                    </x-nav-link>
                    <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                        {{ __('Appointments') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.*')">
                        {{ __('Blog') }}
                    </x-nav-link>
                    @if(optional(Auth::user())->role_id == 1)
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                        <span class="text-indigo-600 dark:text-indigo-400 font-semibold">{{ __('Admin Panel') }}</span>
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side (Search + Profile) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                
                <!-- Search Bar -->
                <div class="relative">
                    <form action="{{ route('community.index') }}" method="GET" class="relative">
                        <input type="text" name="query" placeholder="Search posts, users..." class="w-64 bg-gray-100 dark:bg-gray-700 border-none text-sm rounded-full pl-10 pr-4 py-2 focus:ring-2 focus:ring-[#4CAF50] text-gray-900 dark:text-white transition-all">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                </div>

                <!-- Notifications Dropdown -->
                <x-dropdown align="right" width="80">
                    <x-slot name="trigger">
                        <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 relative p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            <!-- Mock Notification 1 -->
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-500 shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">New message from Trainer</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">"Hey! Don't forget your workout today."</p>
                                        <p class="text-[10px] text-gray-400 mt-1">2 mins ago</p>
                                    </div>
                                </div>
                            </a>
                            <!-- Mock Notification 2 -->
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-500 shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Appointment Reminder</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Yoga class starts in 1 hour.</p>
                                        <p class="text-[10px] text-gray-400 mt-1">1 hour ago</p>
                                    </div>
                                </div>
                            </a>
                            <!-- Mock Notification 3 -->
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition last:border-0">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-500 shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">New comment on your post</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Sarah commented: "Great progress!"</p>
                                        <p class="text-[10px] text-gray-400 mt-1">Yesterday</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="#" class="block px-4 py-2 text-center text-xs font-medium text-blue-500 hover:text-blue-600 dark:hover:text-blue-400 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                            View All Notifications
                        </a>
                    </x-slot>
                </x-dropdown>

                <!-- Settings Dropdown -->
                @if(optional(Auth::user())->id)
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                @if(optional(Auth::user())->avatar)
                                    <img class="h-8 w-8 rounded-full object-cover mr-2 border border-gray-200 dark:border-gray-600" src="{{ Storage::url(optional(Auth::user())->avatar) }}" alt="{{ optional(Auth::user())->name }}" />
                                @else
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center text-white font-bold mr-2 shadow-sm">
                                        {{ substr(optional(Auth::user())->name ?? 'G', 0, 1) }}
                                    </div>
                                @endif
                                <div class="font-semibold">{{ optional(Auth::user())->name ?? __('Guest') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ __('My Profile') }}
                                </div>
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <div class="flex items-center gap-2 text-red-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        {{ __('Log Out') }}
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">{{ __('Register') }}</a>
                    </div>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        
        <div class="p-4">
            <form action="{{ route('community.index') }}" method="GET" class="relative">
                <input type="text" name="query" placeholder="Search..." class="w-full bg-gray-100 dark:bg-gray-700 border-none rounded-lg pl-10 pr-4 py-2 text-sm text-gray-900 dark:text-white">
                <div class="absolute left-3 top-2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Health Tracker') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('community.index')" :active="request()->routeIs('community.*')">
                {{ __('Community') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                {{ __('Appointments') }}
            </x-responsive-nav-link>
            @if(optional(Auth::user())->role_id == 1)
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                <span class="text-indigo-600 dark:text-indigo-400 font-semibold">{{ __('Admin Panel') }}</span>
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
            <div class="px-4 flex items-center gap-3">
                @if(optional(Auth::user())->avatar)
                    <img class="h-10 w-10 rounded-full object-cover border border-gray-200 dark:border-gray-600" src="{{ Storage::url(optional(Auth::user())->avatar) }}" alt="{{ optional(Auth::user())->name }}" />
                @else
                    <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center text-white font-bold shadow-sm">
                        {{ substr(optional(Auth::user())->name ?? 'G', 0, 1) }}
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ optional(Auth::user())->name ?? __('Guest') }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ optional(Auth::user())->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-500">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('login') }}" class="block text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="block text-sm font-medium text-blue-600 hover:text-blue-700">{{ __('Register') }}</a>
            </div>
        @endauth
        </div>
    </div>
</nav>
