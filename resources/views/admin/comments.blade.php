<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Comments') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-[#1e293b] border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">User</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Post</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Comment</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse($comments as $comment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 text-gray-900 dark:text-white">{{ $comment->user->name ?? 'Unknown' }}</td>
                                <td class="p-4 text-gray-500 dark:text-gray-400 truncate max-w-[200px]">{{ $comment->post->title ?? 'Deleted Post' }}</td>
                                <td class="p-4 text-gray-900 dark:text-gray-200 truncate max-w-[300px]">{{ $comment->comment }}</td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500">No comments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
