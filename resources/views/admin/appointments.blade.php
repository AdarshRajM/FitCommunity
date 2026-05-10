<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-[#1e293b] border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">User</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Doctor</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Date & Time</th>
                            <th class="p-4 text-gray-600 dark:text-gray-300 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 text-gray-900 dark:text-white">{{ $appointment->user->name ?? 'Unknown' }}</td>
                                <td class="p-4 text-gray-500 dark:text-gray-400">{{ $appointment->doctor->name ?? 'Unassigned' }}</td>
                                <td class="p-4 text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                        {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-700' : ($appointment->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500">No appointments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
