<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nutrition AI') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] dark:bg-[#0b1121] min-h-screen font-sans">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column (Main Content) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Input Section -->
                    <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-6 border border-gray-100 dark:border-gray-800">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Describe your meal</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Tell us what you ate (e.g., "A bowl of oats with blueberries and honey") and we'll estimate the nutrients.</p>
                        
                        <form action="{{ route('nutrition.analyze') }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <textarea name="meal" rows="4" placeholder="Egg" class="w-full bg-gray-100 dark:bg-gray-900 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#20B2AA] text-gray-900 dark:text-white resize-none shadow-inner" required>{{ old('meal', $meal ?? '') }}</textarea>
                            <button type="submit" class="w-full bg-[#20B2AA] hover:bg-[#1C9B95] text-white px-6 py-3 rounded-xl font-bold transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Analyze Nutrition
                            </button>
                        </form>
                    </div>

                    <!-- Analysis Results -->
                    @if(isset($nutritionData))
                    <div class="bg-white dark:bg-gray-50 border-2 border-dashed border-[#8FBC8F] rounded-2xl overflow-hidden animate-[fadeInUp_0.5s_ease-out]">
                        <!-- Header -->
                        <div class="px-6 py-4 flex items-center gap-2">
                            <div class="bg-[#4CAF50] rounded-full p-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </div>
                            <h4 class="font-bold text-gray-800 text-lg">Analysis Results</h4>
                            <div class="ml-auto">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                            </div>
                        </div>

                        <!-- Main Content Area (Dark Theme) -->
                        <div class="p-6 bg-[#1A202C] m-4 rounded-xl shadow-lg relative">
                            <h2 class="text-2xl font-bold text-[#4CAF50] text-center mb-6">{{ $nutritionData['name'] }}</h2>
                            
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                                <div class="bg-[#2D3748] rounded-xl p-4 text-center border border-gray-700 col-span-1 shadow-sm">
                                    <div class="flex items-center justify-center gap-1 text-gray-400 text-xs mb-1 uppercase tracking-wider font-semibold">
                                        <svg class="w-3 h-3 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                                        Calories
                                    </div>
                                    <div class="text-3xl font-bold text-[#4CAF50]">{{ $nutritionData['calories'] }} <span class="text-sm font-normal text-green-600/80">kcal</span></div>
                                </div>

                                <div class="bg-[#2D3748] rounded-xl p-4 text-center border border-gray-700 col-span-1 md:col-span-3 flex items-center justify-around shadow-sm">
                                    <div class="flex-1 text-center">
                                        <div class="text-gray-400 text-xs mb-1 uppercase tracking-wider font-semibold">Protein</div>
                                        <div class="text-xl font-bold text-[#00BFFF]">{{ $nutritionData['protein'] }}g</div>
                                    </div>
                                    <div class="w-px h-8 bg-gray-600"></div>
                                    <div class="flex-1 text-center">
                                        <div class="text-gray-400 text-xs mb-1 uppercase tracking-wider font-semibold">Carbs</div>
                                        <div class="text-xl font-bold text-[#FFD700]">{{ $nutritionData['carbs'] }}g</div>
                                    </div>
                                    <div class="w-px h-8 bg-gray-600"></div>
                                    <div class="flex-1 text-center">
                                        <div class="text-gray-400 text-xs mb-1 uppercase tracking-wider font-semibold">Fats</div>
                                        <div class="text-xl font-bold text-[#FF4500]">{{ $nutritionData['fats'] }}g</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Macronutrient Ratios -->
                            <div class="mb-8">
                                <h4 class="text-white font-bold mb-3 flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                                    Macronutrient Ratios
                                </h4>
                                
                                <div class="w-full h-3 rounded-full flex overflow-hidden mb-3 bg-gray-700">
                                    @if($nutritionData['protein_pct'] > 0)
                                        <div style="width: {{ $nutritionData['protein_pct'] }}%" class="bg-[#00BFFF]"></div>
                                    @endif
                                    @if($nutritionData['carbs_pct'] > 0)
                                        <div style="width: {{ $nutritionData['carbs_pct'] }}%" class="bg-[#FFD700]"></div>
                                    @endif
                                    @if($nutritionData['fats_pct'] > 0)
                                        <div style="width: {{ $nutritionData['fats_pct'] }}%" class="bg-[#FF4500]"></div>
                                    @endif
                                </div>

                                <div class="flex justify-between text-xs font-medium">
                                    <div class="flex items-center gap-1.5 text-gray-400"><span class="w-2.5 h-2.5 rounded-full bg-[#00BFFF]"></span> Protein ({{ $nutritionData['protein_pct'] }}%)</div>
                                    <div class="flex items-center gap-1.5 text-gray-400"><span class="w-2.5 h-2.5 rounded-full bg-[#FFD700]"></span> Carbs ({{ $nutritionData['carbs_pct'] }}%)</div>
                                    <div class="flex items-center gap-1.5 text-gray-400"><span class="w-2.5 h-2.5 rounded-full bg-[#FF4500]"></span> Fats ({{ $nutritionData['fats_pct'] }}%)</div>
                                </div>
                            </div>

                            <hr class="border-gray-700 my-6">

                            <!-- Key Dietary Insights -->
                            <div>
                                <h4 class="text-white font-bold mb-4 flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707.707a1 1 0 00-1.414 1.414l.707-.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                                    Key Dietary Insights
                                </h4>
                                <ul class="space-y-3">
                                    @foreach($nutritionData['insights'] as $insight)
                                        <li class="flex items-start gap-3 text-gray-400 text-sm leading-relaxed">
                                            <div class="bg-[#4CAF50]/20 rounded-full p-0.5 mt-0.5 shrink-0">
                                                <svg class="w-3.5 h-3.5 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            {{ $insight }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Disclaimer -->
                        <div class="px-5 py-3 mx-4 mb-4 bg-[#E8F5E9] rounded-lg flex items-start gap-2 text-xs text-gray-700">
                            <svg class="w-4 h-4 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <p><strong>Disclaimer:</strong> These are AI-generated estimates. For medical advice, please consult a nutritionist.</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="lg:col-span-1 space-y-6">
                    
                    <!-- Why Use This? -->
                    <div class="bg-[#F8FAFC] border border-gray-100 shadow-sm rounded-2xl p-6">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Why use this?</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-[#20B2AA] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Track your daily macro-nutrients.
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-[#20B2AA] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Understand the health impact of meals.
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-[#20B2AA] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Get quick dietary tips instantly.
                            </li>
                        </ul>
                    </div>

                    <!-- Recent Tips -->
                    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Recent Tips</h4>
                        <div class="bg-[#F0FDF4] border border-[#DCFCE7] rounded-xl p-4 text-sm text-gray-600 italic">
                            "Protein at breakfast helps keep you full longer and stabilizes blood sugar."
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
