<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Tasks Created -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-sm font-medium text-gray-500">Total Tasks Created</div>
                    <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalCreated }}</div>
                </div>

                <!-- Tasks Assigned -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-sm font-medium text-gray-500">Tasks Assigned To You</div>
                    <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalAssigned }}</div>
                </div>

                <!-- Tasks Completed -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-sm font-medium text-gray-500">Tasks Completed</div>
                    <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalCompleted }}</div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
