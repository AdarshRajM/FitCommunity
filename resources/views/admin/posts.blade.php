<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-[#1e293b] border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium w-1/2">Title</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Author</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Date</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($posts as $post)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 font-bold text-gray-900 dark:text-white truncate">{{ $post->title }}</td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $post->user->name }}</td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="p-4 text-right">
                                    <form action="{{ route('community.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
