<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Analytics & Reports') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Users -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $reports['total_users'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>

                <!-- Total Posts -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $reports['total_posts'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H12"></path></svg>
                    </div>
                </div>

                <!-- Total Appointments -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Appointments</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $reports['total_appointments'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center text-green-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                <!-- Recent Signups (7 Days) -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">New Users (7 Days)</p>
                        <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">+{{ $reports['recent_signups'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                </div>

                <!-- Recent Posts (7 Days) -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">New Posts (7 Days)</p>
                        <p class="text-3xl font-bold text-pink-600 dark:text-pink-400 mt-2">+{{ $reports['recent_posts'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-pink-50 dark:bg-pink-900/30 flex items-center justify-center text-pink-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
