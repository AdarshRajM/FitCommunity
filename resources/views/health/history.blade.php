<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Progress Report & History') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-[#0f766e] via-[#0d9488] to-[#334155] p-8">
                <div class="text-white">
                    <p class="text-xs uppercase tracking-[0.24em] text-slate-200/80 mb-3">Wellness snapshot</p>
                    <h1 class="text-4xl sm:text-5xl font-bold leading-tight">Your progress report for the week</h1>
                    <p class="mt-4 max-w-2xl text-slate-100/90 text-base">Monitor weight, step count, calories, and mindful rest in one place. This overview helps you stay accountable and move toward balanced health.</p>
                </div>
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-200">Weekly Activity</p>
                        <p class="mt-3 text-3xl font-semibold">42 hrs</p>
                        <p class="mt-1 text-sm text-slate-200/80">Logged movement</p>
                    </div>
                    <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-200">Avg Sleep</p>
                        <p class="mt-3 text-3xl font-semibold">7h 28m</p>
                        <p class="mt-1 text-sm text-slate-200/80">Restored energy</p>
                    </div>
                    <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-200">Hydration</p>
                        <p class="mt-3 text-3xl font-semibold">10 cups</p>
                        <p class="mt-1 text-sm text-slate-200/80">Logged today</p>
                    </div>
                    <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-200">Fuel Quality</p>
                        <p class="mt-3 text-3xl font-semibold">82%</p>
                        <p class="mt-1 text-sm text-slate-200/80">Balanced nutrition</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                <h3 class="font-bold text-gray-900 dark:text-white text-lg border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">Detailed Health Logs</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Your historical health data logs.</p>
                
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-[#1e293b] border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Date</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Weight</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Steps</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Calories</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                            <td class="p-4 text-gray-900 dark:text-white font-medium">Today</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">75 kg</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">8,500</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">2,100 kcal</td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                            <td class="p-4 text-gray-900 dark:text-white font-medium">Yesterday</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">75.2 kg</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">10,200</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">2,500 kcal</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
