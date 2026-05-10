<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('community.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Post Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Main Post -->
            <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-md">
                <div class="p-8">
                    <!-- Post Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-green-400 to-blue-500 p-[2px]">
                                <div class="w-full h-full bg-white dark:bg-gray-900 rounded-full flex items-center justify-center">
                                    <img src="{{ $post->user->avatar ? asset('storage/'.$post->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" class="w-full h-full rounded-full object-cover" alt="{{ $post->user->name }}">
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-base">{{ $post->user->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                        
                        @if(Auth::id() === $post->user_id)
                            <div class="flex gap-2">
                                <a href="{{ route('community.edit', $post) }}" class="p-2 text-gray-400 hover:text-blue-500 bg-gray-50 dark:bg-gray-800 rounded-lg transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                                <form action="{{ route('community.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 bg-gray-50 dark:bg-gray-800 rounded-lg transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Post Content -->
                    <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">{{ $post->title }}</h3>
                    
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-6 text-lg">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    
                    @if($post->hashtags)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($post->hashtags as $tag)
                                <span class="text-sm font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-3 py-1 rounded-md">#{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($post->image)
                        <div class="rounded-xl overflow-hidden mb-6 bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            <img src="{{ asset('storage/posts/images/' . $post->image) }}" alt="Post image" class="w-full h-auto object-cover">
                        </div>
                    @endif
                    
                    @if($post->video)
                        <div class="rounded-xl overflow-hidden mb-6 bg-black flex items-center justify-center">
                            <video src="{{ asset('storage/posts/videos/' . $post->video) }}" controls class="w-full h-auto"></video>
                        </div>
                    @endif

                    <!-- Actions Bar -->
                    <div class="flex items-center gap-8 py-4 border-t border-b border-gray-100 dark:border-gray-800">
                        <form action="{{ route('community.like', $post) }}" method="POST" class="inline">
                            @csrf
                            @php $hasLiked = $post->likes->contains('user_id', Auth::id()); @endphp
                            <button type="submit" class="flex items-center gap-2 text-base font-semibold transition {{ $hasLiked ? 'text-blue-500' : 'text-gray-500 dark:text-gray-400 hover:text-blue-500' }}">
                                <svg class="w-6 h-6 {{ $hasLiked ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                                {{ $post->likes->count() }} Likes
                            </button>
                        </form>

                        <div class="flex items-center gap-2 text-base font-semibold text-gray-500 dark:text-gray-400">
                            <svg class="w-6 h-6 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            {{ $post->comments->count() }} Comments
                        </div>

                        <div class="flex items-center gap-2 text-base font-semibold text-gray-500 dark:text-gray-400 ml-auto">
                            <svg class="w-6 h-6 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{ $post->views ?? 0 }} Views
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div id="comments" class="p-8 bg-gray-50/50 dark:bg-[#0b1121]/50">
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Comments</h4>
                    
                    <!-- Comment Form -->
                    <form action="{{ route('community.comment', $post) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <textarea name="content" rows="2" required class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition" placeholder="Add a comment..."></textarea>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold shadow-md hover:bg-blue-600 transition h-full flex items-center">
                                    Post
                                </button>
                            </div>
                        </div>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </form>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($post->comments->where('parent_id', null) as $comment)
                            <div class="flex gap-4">
                                <img src="{{ $comment->user->avatar ? asset('storage/'.$comment->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" class="w-10 h-10 rounded-full object-cover shrink-0" alt="{{ $comment->user->name }}">
                                <div class="flex-1 bg-white dark:bg-[#161e2e] border border-gray-100 dark:border-gray-800 p-4 rounded-2xl rounded-tl-none shadow-sm">
                                    <div class="flex justify-between items-start mb-2">
                                        <h5 class="font-bold text-gray-900 dark:text-white text-sm">{{ $comment->user->name }}</h5>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm mb-3">{{ $comment->content }}</p>
                                    
                                    @if(Auth::id() === $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this comment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 font-medium hover:underline">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400 py-4">No comments yet. Be the first to start the discussion!</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
