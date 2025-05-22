<x-app-layout>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $task->title }}</h1>

                <div class="mb-4">
                    <p class="text-gray-600"><strong>Description:</strong></p>
                    <p class="text-gray-800">{{ $task->description }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <strong>Status:</strong>
                        <span class="capitalize">{{ $task->status }}</span>
                    </div>

                    <div>
                        <strong>Priority:</strong>
                        <span class="capitalize">{{ $task->priority }}</span>
                    </div>

                    <div>
                        <strong>Due Date:</strong>
                        <span>{{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</span>
                    </div>

                    <div>
                        <strong>Created By:</strong>
                        <span>{{ $task->user->name }}</span>
                    </div>

                    @if ($task->attachment)
                        <div class="col-span-2">
                            <strong>Attachment:</strong><br>
                            <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                class="text-blue-600 underline">
                                View Attachment
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex gap-2">
                    <x-primary-button>
                        <a href="{{ route('tasks.edit', $task) }}">
                            Edit Task
                        </a>
                    </x-primary-button>

                    <x-secondary-button>
                        <a href="{{ route('tasks.index') }}">
                            Back to List
                        </a>
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
