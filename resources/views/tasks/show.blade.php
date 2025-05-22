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
                    {{-- Comments --}}
                    <form action="{{ route('tasks.comments.store', $task) }}" method="POST" class="mb-6">
                        @csrf
                        <textarea name="comment" rows="3" class="w-full border rounded px-3 py-2" placeholder="Add a comment...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit">
                            <x-primary-button>
                                Add Comment
                            </x-primary-button>
                        </button>
                    </form>
                </div>


                <div class="space-y-4">
                    <h3 class="font-semibold text-lg mb-2">Comments</h3>
                    @forelse($task->comments as $comment)
                        <div class="border rounded p-4 bg-gray-50">
                            <p class="text-sm text-gray-800">{{ $comment->comment }}</p>
                            <div class="text-xs text-gray-500 mt-1">
                                — {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No comments yet.</p>
                    @endforelse
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
