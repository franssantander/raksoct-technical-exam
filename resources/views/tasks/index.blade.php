<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks Management') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Create Task Button -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('tasks.create') }}" class="inline-block text-white rounded transition">
                    <x-primary-button>
                        + Create Task
                    </x-primary-button>
                </a>
            </div>

            <!-- Tasks Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900">
                    @foreach ($tasks as $task)
                        <div class="border rounded-md p-5 shadow-sm hover:shadow-md transition bg-gray-50 p-4">
                            <!-- Title and Status -->
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        {{ $task->title }}
                                        <span class="ml-2 text-sm text-gray-500">({{ ucfirst($task->status) }})</span>
                                    </h2>
                                    @if ($task->trashed())
                                        <span
                                            class="inline-block mt-1 text-xs bg-gray-300 text-gray-700 px-2 py-1 rounded">Archived</span>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 flex-wrap justify-end">
                                    @if (!$task->trashed())
                                        <!-- View -->
                                        <a href="{{ route('tasks.show', $task) }}">
                                            <x-primary-button>
                                                View
                                            </x-primary-button>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('tasks.edit', $task) }}">
                                            <x-primary-button>
                                                Edit
                                            </x-primary-button>
                                        </a>

                                        <!-- Archive -->
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to archive this task?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="submit">
                                                Archive
                                            </x-primary-button>
                                        </form>
                                    @else
                                        <!-- Restore -->
                                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST">
                                            @csrf
                                            <x-primary-button type="submit"
                                                class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">
                                                Restore
                                            </x-primary-button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="text-sm text-gray-700 mt-2 whitespace-pre-wrap">
                                {{ $task->description }}
                            </div>

                            <!-- Due Date & Priority -->
                            <div class="text-xs text-gray-500 mt-3 flex gap-4">
                                <span>📅 Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                                <span>⭐ Priority: {{ ucfirst($task->priority) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
