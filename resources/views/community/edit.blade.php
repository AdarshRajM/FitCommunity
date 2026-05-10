<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('community.show', $post) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm">
                <div class="p-8">
                    
                    @if ($errors->any())
                        <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded mb-6">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('community.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                                class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition">
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                            <textarea name="content" id="content" rows="6" required
                                class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition">{{ old('content', $post->content) }}</textarea>
                        </div>
                        
                        <!-- Hashtags -->
                        <div>
                            <label for="hashtags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hashtags <span class="text-xs text-gray-500">(comma separated)</span></label>
                            <input type="text" name="hashtags" id="hashtags" value="{{ old('hashtags', is_array($post->hashtags) ? implode(', ', $post->hashtags) : '') }}"
                                class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition">
                        </div>

                        <!-- Media Upload -->
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Image <span class="text-xs text-gray-500">(Max 5MB)</span></label>
                            
                            @if($post->image)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-2">Current Image:</p>
                                    <img src="{{ asset('storage/posts/images/' . $post->image) }}" class="h-32 object-cover rounded-xl" alt="Current image">
                                </div>
                            @endif

                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:hover:border-gray-600 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500 dark:text-gray-400">
                                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-sm font-semibold">Click to upload new image</p>
                                    </div>
                                    <input id="image" name="image" type="file" accept="image/*" class="hidden" />
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 gap-4">
                            <a href="{{ route('community.show', $post) }}" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-6 py-3 rounded-full font-bold shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-600 hover:shadow-xl transition transform hover:-translate-y-0.5">
                                Update Post
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
