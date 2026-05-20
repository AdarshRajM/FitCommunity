<x-app-layout>
    <div class="min-h-screen bg-[#f8fafc] text-slate-800 font-sans pb-12">
        <!-- Dashboard Navigation Context (Optional but good for flow) -->
        <div class="bg-white border-b border-slate-200 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/dashboard" class="flex items-center gap-2 text-slate-600 hover:text-green-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-medium">Back to Dashboard</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('community.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full font-medium shadow-md shadow-green-600/20 transition-all transform hover:-translate-y-0.5 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Share Experience
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-12">
            
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hero Header -->
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-3 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Community Pulse
                </h1>
                <p class="text-slate-500 text-lg">Stories, tips, and experiences from our wellness community</p>
            </div>

            <!-- Search & Filters -->
            <form action="{{ route('community.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 mb-12">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search posts..." class="w-full bg-slate-100 border-none text-slate-700 rounded-full pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 transition shadow-inner">
                </div>

                <div class="relative min-w-[160px]">
                    <select name="category" onchange="this.form.submit()" class="w-full bg-slate-100 border-none text-slate-700 rounded-full pl-4 pr-10 py-3 focus:ring-2 focus:ring-green-500 appearance-none cursor-pointer hover:bg-slate-200 transition">
                        <option value="">All Categories</option>
                        <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General</option>
                        <option value="fitness" {{ request('category') == 'fitness' ? 'selected' : '' }}>Fitness</option>
                        <option value="mentalhealth" {{ request('category') == 'mentalhealth' ? 'selected' : '' }}>Mental health</option>
                        <option value="nutrition" {{ request('category') == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                        <option value="meditation" {{ request('category') == 'meditation' ? 'selected' : '' }}>Meditation</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <div class="relative min-w-[140px]">
                    <select name="sort" onchange="this.form.submit()" class="w-full bg-slate-100 border-none text-slate-700 rounded-full pl-4 pr-10 py-3 focus:ring-2 focus:ring-green-500 appearance-none cursor-pointer hover:bg-slate-200 transition">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Latest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <button type="submit" class="bg-[#17b890] hover:bg-[#129976] text-white px-6 py-3 rounded-full font-medium transition flex items-center gap-2 shadow-md shadow-green-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
            </form>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content Area -->
                <div class="flex-1">
                    <p class="text-slate-500 text-sm mb-4">{{ $posts->total() }} posts found</p>

                    @if($posts->isEmpty())
                        <!-- Empty State matching screenshot -->
                        <div class="bg-white rounded-3xl border border-slate-200 p-16 text-center shadow-sm">
                            <div class="w-24 h-24 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-12 h-12 text-[#8b5cf6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-2">No posts found</h3>
                            <p class="text-slate-500">Try adjusting your search or be the first to post!</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($posts as $post)
                                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-green-100">
                                                <img src="{{ $post->user->avatar ? asset('storage/'.$post->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover" alt="{{ $post->user->name }}">
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-800">
                                                    {{ $post->user->name }}
                                                    @if($post->user->profession)
                                                        <span class="text-xs font-normal ml-2 px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-200">{{ $post->user->profession }}</span>
                                                    @endif
                                                </h4>
                                                <p class="text-xs text-slate-400">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('community.show', $post) }}" class="block group">
                                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-green-600 transition-colors">{{ $post->title }}</h3>
                                        <p class="text-slate-600 mb-4 line-clamp-3">{{ $post->content }}</p>
                                        
                                        @if($post->image)
                                            <div class="rounded-2xl overflow-hidden mb-4 bg-slate-50">
                                                <img src="{{ asset('storage/posts/images/' . $post->image) }}" class="w-full max-h-96 object-cover" alt="Post Image">
                                            </div>
                                        @endif
                                        @if($post->video)
                                            <div class="rounded-2xl overflow-hidden mb-4 bg-black">
                                                <video src="{{ asset('storage/posts/videos/' . $post->video) }}" controls class="w-full max-h-96"></video>
                                            </div>
                                        @endif
                                    </a>

                                    <div class="flex items-center gap-6 mt-4 pt-4 border-t border-slate-100 text-sm font-medium">
                                        <form action="{{ route('community.like', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @php $hasLiked = $post->likes->contains('user_id', Auth::id()); @endphp
                                            <button type="submit" class="flex items-center gap-2 transition {{ $hasLiked ? 'text-green-600' : 'text-slate-500 hover:text-green-600' }}">
                                                <svg class="w-5 h-5 {{ $hasLiked ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                                                {{ $post->likes->count() }} Likes
                                            </button>
                                        </form>

                                        <a href="{{ route('community.show', $post) }}#comments" class="flex items-center gap-2 text-slate-500 hover:text-green-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                            {{ $post->comments->count() }} Comments
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar Area -->
                <div class="w-full lg:w-80 space-y-6">
                    <!-- Browse Categories Widget -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Wellness Support Groups</h4>
                        <ul class="space-y-2 text-sm font-medium">
                            <li>
                                <a href="{{ route('community.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ !request('category') ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    All Posts
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'general']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request('category') == 'general' ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    General
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'fitness']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request('category') == 'fitness' ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                    Fitness
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'mentalhealth']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request('category') == 'mentalhealth' ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <span class="text-slate-400">🧠</span>
                                    Mental health
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'nutrition']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request('category') == 'nutrition' ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <span class="text-slate-400">🍎</span>
                                    Nutrition
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('community.index', ['category' => 'meditation']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request('category') == 'meditation' ? 'bg-[#d1fae5]/50 text-[#047857]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <span class="text-slate-400">🧘</span>
                                    Meditation
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Call to action -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-3xl p-6 text-center shadow-sm">
                        <h4 class="text-lg font-bold text-green-800 mb-2">Share a Wellness Experience</h4>
                        <p class="text-sm text-green-700 mb-6">Your story might be exactly what someone else in the community needs to hear today. Share your journey, struggles, or victories.</p>
                        <a href="{{ route('community.create') }}" class="inline-block w-full bg-green-600 hover:bg-green-700 text-white rounded-2xl py-3 font-bold transition shadow-md shadow-green-600/20 group">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                WRITE A POST
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
