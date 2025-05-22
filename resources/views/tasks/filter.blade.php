<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Filter Tasks</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-6">
        <div class="p-6 bg-white shadow-sm rounded-lg">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('tasks.filter') }}" class="mb-4 flex items-center gap-4">
                <label for="status" class="font-semibold">Filter by Status:</label>
                <select name="status" id="status" class="border rounded px-2 py-1">
                    <option value="">All</option>
                    <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                </select>
                <x-primary-button type="submit">Filter</x-primary-button>
            </form>

            <!-- Filtered Tasks List -->
            @if ($tasks->count())
                @foreach ($tasks as $task)
                    <div class="border-b py-4">
                        <h3 class="font-semibold">{{ $task->title }} <small
                                class="text-gray-500">({{ ucfirst($task->status) }})</small></h3>
                        <p class="text-sm text-gray-700">{{ Str::limit($task->description, 100) }}</p>
                    </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $tasks->withQueryString()->links() }}
                </div>
            @else
                <p>No tasks found for the selected filter.</p>
            @endif
        </div>
    </div>
</x-app-layout>
