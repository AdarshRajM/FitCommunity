<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        
        <!-- Premium Header Banner -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 relative overflow-hidden shadow-2xl flex items-center justify-between">
                <div class="relative z-10 text-white w-full md:w-2/3">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold tracking-wider mb-4 inline-block">HEALTHCARE CONNECT</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight">Expert Consultations, <br/> Anytime, Anywhere.</h2>
                    <p class="text-blue-100 text-lg">Connect with certified health professionals or consult our AI Doctor for quick advice.</p>
                <div class="mt-6 flex gap-4">
                    <button onclick="window.dispatchEvent(new CustomEvent('open-ai-chat'))" class="bg-white text-blue-600 px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Ask AI Doctor Now
                    </button>
                </div>
                </div>
                <div class="hidden md:block relative z-10 opacity-80">
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <!-- Abstract Background Shapes -->
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute left-1/2 -bottom-20 w-64 h-64 bg-indigo-900/40 rounded-full blur-2xl"></div>
            </div>
        </div>

        <!-- Group Wellness Sessions -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Group Wellness Sessions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Session 1 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-sm hover:shadow-lg transition group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-green-500">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Anxiety Support Circle</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">A safe space guided by a certified therapist to discuss managing anxiety.</p>
                    <div class="flex items-center gap-2 text-sm font-bold text-green-600 mb-4">
                        <span>Today, 7:00 PM</span>
                        <span>•</span>
                        <span>8 Spots Left</span>
                    </div>
                    <button onclick="alert('Joining Yoga for Beginners session...')" class="w-full bg-green-50 text-green-600 border border-green-200 hover:bg-green-600 hover:text-white px-4 py-2 rounded-xl font-medium transition">Join Group Session</button>
                </div>

                <!-- Session 2 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-sm hover:shadow-lg transition group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-orange-500">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.506.45l-4.258 2.77a.5.5 0 01-.753-.418v-4.14a.5.5 0 00-.5-.5H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10.546z"></path></svg>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Nutrition Q&A</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Live Q&A with our expert dietitians. Bring your meal prep questions!</p>
                    <div class="flex items-center gap-2 text-sm font-bold text-orange-600 mb-4">
                        <span>Tomorrow, 12:00 PM</span>
                        <span>•</span>
                        <span>25 Spots Left</span>
                    </div>
                    <button class="w-full bg-orange-50 text-orange-600 border border-orange-200 hover:bg-orange-600 hover:text-white px-4 py-2 rounded-xl font-medium transition">Reserve Spot</button>
                </div>

                <!-- Session 3 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-sm hover:shadow-lg transition group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-purple-500">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Postpartum Wellness</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Connect with other new mothers. Share experiences and wellness tips.</p>
                    <div class="flex items-center gap-2 text-sm font-bold text-purple-600 mb-4">
                        <span>Friday, 10:00 AM</span>
                        <span>•</span>
                        <span>12 Spots Left</span>
                    </div>
                    <button onclick="alert('Joining Mental Wellness Circle...')" class="w-full bg-purple-50 text-purple-600 border border-purple-200 hover:bg-purple-600 hover:text-white px-4 py-2 rounded-xl font-medium transition">Join Group Session</button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100/80 backdrop-blur-md border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Book Appointment Form -->
                <div class="md:col-span-1">
                    <div class="bg-white/80 dark:bg-[#161e2e]/80 backdrop-blur-xl shadow-lg rounded-3xl p-8 border border-gray-200 dark:border-gray-800 transition-all hover:shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Book New</h3>
                        </div>
                        
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="doctor_id" :value="__('Select Specialist')" />
                                    <select name="doctor_id" id="doctor_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                                        <option value="">Choose a doctor or trainer...</option>
                                        @foreach($doctors as $doc)
                                            <option value="{{ $doc->id }}">{{ $doc->name }} ({{ ucfirst($doc->role) }})</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('doctor_id')" />
                                </div>

                                <div>
                                    <x-input-label for="title" :value="__('Reason / Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="e.g. Diet Consultation" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div>
                                    <x-input-label for="appointment_date" :value="__('Date & Time')" />
                                    <x-text-input id="appointment_date" name="appointment_date" type="datetime-local" class="mt-1 block w-full" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('appointment_date')" />
                                </div>

                                <div>
                                    <x-input-label for="duration" :value="__('Duration')" />
                                    <select name="duration" id="duration" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                                        <option value="30">30 Minutes</option>
                                        <option value="60">1 Hour</option>
                                        <option value="90">1.5 Hours</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                                </div>

                                <div>
                                    <x-input-label for="notes" :value="__('Additional Notes (Optional)')" />
                                    <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"></textarea>
                                </div>

                                <x-primary-button class="w-full justify-center">{{ __('Book Appointment') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Appointments List -->
                <div class="md:col-span-2">
                    <div class="bg-white/80 dark:bg-[#161e2e]/80 backdrop-blur-xl shadow-lg rounded-3xl p-8 border border-gray-200 dark:border-gray-800 h-full transition-all hover:shadow-xl">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Your Schedule</h3>
                            </div>
                            <span class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 text-xs font-bold px-3 py-1 rounded-full">{{ count($appointments) }} Total</span>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($appointments as $apt)
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl flex flex-col sm:flex-row gap-4 items-center justify-between {{ $apt->status === 'pending' ? 'bg-yellow-50 dark:bg-yellow-900/10 border-yellow-200 dark:border-yellow-800' : '' }}">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $apt->title }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            <span class="font-medium text-gray-900 dark:text-gray-200">With:</span> 
                                            {{ Auth::id() === $apt->user_id ? $apt->doctor->name : $apt->user->name }}
                                        </p>
                                        <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y h:i A') }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $apt->duration }} mins
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2 items-end shrink-0">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                            {{ $apt->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                              ($apt->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                              ($apt->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $apt->status }}
                                        </span>

                                        @if(Auth::id() === $apt->doctor_id && $apt->status === 'pending')
                                            <div class="flex gap-2">
                                                <form action="{{ route('appointments.status', $apt) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="text-xs bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 transition">Confirm</button>
                                                </form>
                                                <form action="{{ route('appointments.status', $apt) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition">Cancel</button>
                                                </form>
                                            </div>
                                        @elseif($apt->status === 'pending')
                                            <form action="{{ route('appointments.status', $apt) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition">Cancel Request</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p>No appointments found. Book one today!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
