<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Health Blogs') }}
            </h2>
            <a href="{{ route('blogs.create') }}" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-6 py-2 rounded-full font-medium shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                + Write Article
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Featured Wellness Story -->
            <div class="bg-gradient-to-r from-blue-900 to-indigo-900 rounded-3xl overflow-hidden shadow-2xl border border-indigo-500/30 mb-12 flex flex-col md:flex-row relative group cursor-pointer">
                <div class="w-full md:w-1/2 p-10 flex flex-col justify-center z-10">
                    <span class="bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider self-start mb-4">Featured Member Story</span>
                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight group-hover:text-indigo-300 transition">How Community Support Changed My Recovery Journey</h3>
                    <p class="text-indigo-100/80 mb-6 line-clamp-3 text-lg">"When I was diagnosed with early-stage hypertension, I felt completely alone. It wasn't until I joined the FitCommunity hypertension support group that I finally found the motivation to stick to my daily walks and meditation routine."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/100?img=47" class="w-12 h-12 rounded-full border-2 border-indigo-400" alt="Sarah J.">
                        <div>
                            <p class="text-white font-bold">Sarah Jenkins</p>
                            <p class="text-indigo-300 text-sm">Community Member • 5 min read</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 relative h-64 md:h-auto overflow-hidden bg-black/50">
                    <img src="https://images.unsplash.com/photo-1517021897933-0e0319cfbc28?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Wellness" class="w-full h-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-80 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-transparent w-1/3 md:w-1/2"></div>
                </div>
            </div>

            <div class="flex justify-between items-end mb-6">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Recent Articles</h3>
                <div class="flex gap-2">
                    <button class="text-sm font-medium text-indigo-500 hover:text-indigo-400">View All</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($blogs as $blog)
                <!-- Blog Card -->
                <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-md transition">
                    @if($blog->video_path)
                        <div class="h-48 bg-black">
                            <video src="{{ asset('storage/blogs/videos/' . $blog->video_path) }}" controls class="w-full h-full object-cover"></video>
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white/50 text-4xl font-bold">
                            {{ substr($blog->title, 0, 1) }}
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">{{ $blog->category }}</span>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-2 mb-3">{{ $blog->title }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-3">{{ Str::limit($blog->content, 100) }}</p>
                        <a href="{{ route('blogs.show', $blog) }}" class="text-indigo-500 hover:text-indigo-600 font-medium text-sm flex items-center gap-1">Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No articles published yet.
                </div>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
