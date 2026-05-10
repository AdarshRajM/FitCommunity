@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#1e293b]/80 backdrop-blur-md overflow-hidden shadow-sm sm:rounded-lg border border-slate-700/50 p-6">
            <h2 class="text-2xl font-bold text-white mb-6">Create New Doctor Account</h2>

            @if(session('error'))
                <div class="bg-red-500/20 text-red-400 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.doctors.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block font-medium text-sm text-slate-300">Name</label>
                    <input id="name" class="block mt-1 w-full bg-[#0f172a] border border-slate-700 rounded-md text-white px-4 py-2 focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50]/20" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    @error('name')
                        <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-medium text-sm text-slate-300">Email</label>
                    <input id="email" class="block mt-1 w-full bg-[#0f172a] border border-slate-700 rounded-md text-white px-4 py-2 focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50]/20" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specialization -->
                <div>
                    <label for="specialization" class="block font-medium text-sm text-slate-300">Specialization</label>
                    <input id="specialization" class="block mt-1 w-full bg-[#0f172a] border border-slate-700 rounded-md text-white px-4 py-2 focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50]/20" type="text" name="specialization" value="{{ old('specialization') }}" placeholder="e.g., Cardiologist, Nutritionist" required />
                    @error('specialization')
                        <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-sm text-slate-300">Password</label>
                    <input id="password" class="block mt-1 w-full bg-[#0f172a] border border-slate-700 rounded-md text-white px-4 py-2 focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50]/20" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block font-medium text-sm text-slate-300">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full bg-[#0f172a] border border-slate-700 rounded-md text-white px-4 py-2 focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50]/20" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.users') }}" class="underline text-sm text-slate-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                        Cancel
                    </a>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#4CAF50] to-[#2196F3] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Create Doctor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
