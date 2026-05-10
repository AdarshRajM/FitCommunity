<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-[#1e293b] border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Name</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Email</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Role</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="w-8 h-8 rounded-full">
                                    {{ $user->name }}
                                </td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="p-4"><span class="px-2 py-1 rounded bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold uppercase">{{ $user->role->role_name ?? 'USER' }}</span></td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
