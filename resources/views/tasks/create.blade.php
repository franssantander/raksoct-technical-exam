<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isset($task) ? 'Edit Task' : 'Create Task' }}
            </h2>
            <x-secondary-button>
                <a href="{{ route('tasks.index') }}">
                    Back to List
                </a>
            </x-secondary-button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form method="POST" action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($task))
                        @method('PUT')
                    @endif

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="title">Title</label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $task->title ?? '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Description</label>
                        <textarea name="description" id="description"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                            rows="4">{{ old('description', $task->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="status">Status</label>
                        <select name="status" id="status"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="todo"
                                {{ old('status', $task->status ?? '') === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in-progress"
                                {{ old('status', $task->status ?? '') === 'in-progress' ? 'selected' : '' }}>In Progress
                            </option>
                            <option value="done"
                                {{ old('status', $task->status ?? '') === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="priority">Priority</label>
                        <select name="priority" id="priority"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="high"
                                {{ old('priority', $task->priority ?? '') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium"
                                {{ old('priority', $task->priority ?? '') === 'medium' ? 'selected' : '' }}>Medium
                            </option>
                            <option value="low"
                                {{ old('priority', $task->priority ?? '') === 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="due_date">Due Date</label>
                        <input type="date" name="due_date" id="due_date"
                            value="{{ old('due_date', isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- File Upload -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="attachment">Attachment</label>
                        <input type="file" name="attachment" id="attachment"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end w-full">
                        {{-- <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            {{ isset($task) ? 'Update Task' : 'Create Task' }}
                        </button> --}}

                        <div class="flex justify-end w-full">
                            <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                                {{ isset($task) ? 'Update Task' : 'Create Task' }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
