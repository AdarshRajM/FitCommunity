<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                <h3 class="font-bold text-gray-900 dark:text-white text-lg border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">Account Settings</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Manage your general account preferences here.</p>
                
                <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-600 transition">Go to Profile Manager</a>
            </div>
        </div>
    </div>
</x-app-layout>
