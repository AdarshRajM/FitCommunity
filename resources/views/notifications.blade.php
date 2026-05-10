<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center gap-4 border-l-4 border-blue-500">
                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 dark:text-white">Welcome to FitCommunity!</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Thank you for joining our advanced health ecosystem. Update your profile to get started.</p>
                </div>
                <span class="text-xs text-gray-400">2 mins ago</span>
            </div>
            
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-green-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 dark:text-white">Profile Updated</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Your health metrics have been saved successfully.</p>
                </div>
                <span class="text-xs text-gray-400">1 hour ago</span>
            </div>
        </div>
    </div>
</x-app-layout>
