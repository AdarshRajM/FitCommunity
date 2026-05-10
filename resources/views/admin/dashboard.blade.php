<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-blue-500/30">
                    <h3 class="text-blue-100 font-medium">Total Users</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalUsers }}</p>
                </div>
                <!-- Active Users (Last 30 Days) -->
                <div class="bg-gradient-to-br from-teal-400 to-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/30">
                    <h3 class="text-teal-100 font-medium">Active Users</h3>
                    <p class="text-4xl font-bold mt-2">{{ $activeUsers ?? 0 }}</p>
                </div>
                <!-- Total Posts -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white shadow-lg shadow-purple-500/30">
                    <h3 class="text-purple-100 font-medium">Total Posts</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalPosts }}</p>
                </div>
                <!-- Total Comments -->
                <div class="bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl p-6 text-white shadow-lg shadow-orange-500/30">
                    <h3 class="text-orange-100 font-medium">Total Comments</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalComments ?? 0 }}</p>
                </div>
            </div>

            <!-- Analytics Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <!-- User Growth Line Chart -->
                <div class="bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6 lg:col-span-2">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4">User Growth (Last 7 Days)</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Content Distribution Pie Chart -->
                <div class="bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4">Content Distribution</h3>
                    <div class="relative h-72 w-full flex justify-center">
                        <canvas id="contentDistChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- Recent Users -->
                <div class="bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg">Recent Users</h3>
                        <a href="{{ route('admin.users') }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium">View All</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                                <span class="ml-auto text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">{{ ucfirst($user->role) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg">Recent Posts</h3>
                        <a href="{{ route('admin.posts') }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium">View All</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentPosts as $post)
                            <div class="flex items-center gap-3 pb-3 border-b border-gray-100 dark:border-gray-800 last:border-0 last:pb-0">
                                <div class="flex-1 overflow-hidden">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $post->title }}</h4>
                                    <p class="text-xs text-gray-500 truncate">By {{ $post->user->name }}</p>
                                </div>
                                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Initialize Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = document.documentElement.classList.contains('dark') || window.matchMedia('(prefers-color-scheme: dark)').matches;
            const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDarkMode ? 'rgba(255, 255, 255, 0.6)' : 'rgba(0, 0, 0, 0.6)';

            const sharedOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: textColor, font: { family: "'Inter', sans-serif" } }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: textColor }
                    },
                    y: {
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { color: textColor }
                    }
                }
            };

            // User Growth Chart (Line)
            const ctxUserGrowth = document.getElementById('userGrowthChart').getContext('2d');
            let gradientBlue = ctxUserGrowth.createLinearGradient(0, 0, 0, 400);
            gradientBlue.addColorStop(0, 'rgba(33, 150, 243, 0.5)');
            gradientBlue.addColorStop(1, 'rgba(33, 150, 243, 0.0)');

            new Chart(ctxUserGrowth, {
                type: 'line',
                data: {
                    labels: {!! json_encode($userGrowthLabels) !!},
                    datasets: [{
                        label: 'New Users',
                        data: {!! json_encode($userGrowthData) !!},
                        borderColor: '#2196F3',
                        backgroundColor: gradientBlue,
                        borderWidth: 3,
                        pointBackgroundColor: '#2196F3',
                        pointBorderColor: '#fff',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: sharedOptions
            });

            // Content Distribution Chart (Doughnut)
            const ctxContentDist = document.getElementById('contentDistChart').getContext('2d');
            new Chart(ctxContentDist, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($contentLabels) !!},
                    datasets: [{
                        data: {!! json_encode($contentData) !!},
                        backgroundColor: ['#4CAF50', '#2196F3', '#9C27B0', '#FF9800'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: textColor } }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</x-app-layout>
