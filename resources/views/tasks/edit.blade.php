<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Task
            </h2>
            <x-secondary-button>
                <a href="{{ route('tasks.index') }}">
                    Back to List
                </a>
            </x-secondary-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded px-8 py-6">
                <form method="POST" action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($task))
                        @method('PUT')
                    @endif

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}"
                            class="w-full border {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-500" />
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-500">{{ old('description', $task->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                        <select name="status"
                            class="w-full border {{ $errors->has('status') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-500">
                            <option value="todo"
                                {{ old('status', $task->status ?? '') === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in-progress"
                                {{ old('status', $task->status ?? '') === 'in-progress' ? 'selected' : '' }}>In
                                Progress
                            </option>
                            <option value="done"
                                {{ old('status', $task->status ?? '') === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Priority</label>
                        <select name="priority"
                            class="w-full border {{ $errors->has('priority') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-500">
                            <option value="high"
                                {{ old('priority', $task->priority ?? '') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium"
                                {{ old('priority', $task->priority ?? '') === 'medium' ? 'selected' : '' }}>Medium
                            </option>
                            <option value="low"
                                {{ old('priority', $task->priority ?? '') === 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                        @error('priority')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date ?? '') }}"
                            class="w-full border {{ $errors->has('due_date') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-500" />
                        @error('due_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Attachment -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Attachment</label>
                        <input type="file" name="attachment"
                            class="w-full border {{ $errors->has('attachment') ? 'border-red-500' : 'border-gray-300' }} rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700" />
                        @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <x-primary-button type="submit">
                            Update task
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
