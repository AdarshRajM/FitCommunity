<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <!-- External Assets for Advanced UI -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }
        .text-gradient {
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-custom {
            background: linear-gradient(135deg, #4CAF50, #2196F3);
        }
    </style>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="glass-card sm:rounded-2xl p-8 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#4CAF50] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-[#2196F3] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, <span class="text-gradient">{{ Auth::user()->name }}</span>!</h3>
                        <p class="text-gray-600 dark:text-gray-400">You're on a 5-day streak. Keep pushing towards your goals!</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex gap-4">
                        <button class="bg-gradient-custom text-white px-6 py-2 rounded-full font-medium shadow-lg hover:opacity-90 transition">
                            Log Activity
                        </button>
                    </div>
                </div>
            </div>

            <!-- Health Summary Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Steps Widget -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Daily Steps</p>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">8,432</h4>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 84%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">84% of daily goal</p>
                </div>

                <!-- Calories Widget -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Calories Burned</p>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">1,240 <span class="text-sm font-normal text-gray-500">kcal</span></h4>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 62%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">62% of daily goal</p>
                </div>

                <!-- Water Widget -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Water Intake</p>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">1.8 <span class="text-sm font-normal text-gray-500">Liters</span></h4>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center text-cyan-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                        <div class="bg-cyan-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">45% of daily goal</p>
                </div>

                <!-- BMI Widget -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Current BMI</p>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">22.4</h4>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-2 inline-block px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-semibold">
                        Normal Weight
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Activity Chart -->
                <div class="glass-card p-6 rounded-2xl lg:col-span-2" data-aos="fade-up">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Activity Overview</h3>
                        <select class="bg-transparent border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300 text-sm rounded-lg focus:ring-[#4CAF50] focus:border-[#4CAF50] block p-2">
                            <option>This Week</option>
                            <option>This Month</option>
                            <option>This Year</option>
                        </select>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                <!-- Recent Notifications/Activity -->
                <div class="glass-card p-6 rounded-2xl flex flex-col" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Recent Activity</h3>
                    <div class="flex-1 overflow-y-auto pr-2 space-y-4">
                        
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-500 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Goal Reached</h5>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">You hit your 10,000 steps goal today!</p>
                                <span class="text-xs text-gray-400 mt-1 block">2 hours ago</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-500 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Appointment Confirmed</h5>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Dr. Smith confirmed your meeting for tomorrow.</p>
                                <span class="text-xs text-gray-400 mt-1 block">5 hours ago</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-500 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white">New Community Post</h5>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Sarah commented on your workout routine.</p>
                                <span class="text-xs text-gray-400 mt-1 block">Yesterday</span>
                            </div>
                        </div>

                    </div>
                    <button class="w-full mt-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        View All Activity
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Initialize Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

            // Initialize Chart.js
            const ctx = document.getElementById('activityChart').getContext('2d');
            
            // Gradient for chart line
            let gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
            gradientBlue.addColorStop(0, 'rgba(33, 150, 243, 0.5)');
            gradientBlue.addColorStop(1, 'rgba(33, 150, 243, 0.0)');

            let gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
            gradientGreen.addColorStop(0, 'rgba(76, 175, 80, 0.5)');
            gradientGreen.addColorStop(1, 'rgba(76, 175, 80, 0.0)');

            // Check if Dark Mode is active to adjust chart colors
            const isDarkMode = document.documentElement.classList.contains('dark') || window.matchMedia('(prefers-color-scheme: dark)').matches;
            const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDarkMode ? 'rgba(255, 255, 255, 0.6)' : 'rgba(0, 0, 0, 0.6)';

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            label: 'Steps',
                            data: [6500, 7200, 8400, 8100, 9500, 10200, 8432],
                            borderColor: '#2196F3',
                            backgroundColor: gradientBlue,
                            borderWidth: 3,
                            pointBackgroundColor: '#2196F3',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Calories (kcal)',
                            data: [2100, 2300, 2450, 2200, 2600, 2800, 2100],
                            borderColor: '#4CAF50',
                            backgroundColor: gradientGreen,
                            borderWidth: 3,
                            pointBackgroundColor: '#4CAF50',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: { color: textColor, font: { family: "'Inter', sans-serif" } }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: isDarkMode ? 'rgba(15, 23, 42, 0.9)' : 'rgba(255, 255, 255, 0.9)',
                            titleColor: isDarkMode ? '#fff' : '#000',
                            bodyColor: isDarkMode ? '#cbd5e1' : '#334155',
                            borderColor: isDarkMode ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)',
                            borderWidth: 1,
                            padding: 10
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
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>
</x-app-layout>
