@extends('layouts.app')

@section('content')
    <h1 class="my-4">Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}">
        </div>
        <div class="mb-3">
    <label for="priority" class="form-label">Priority</label>
    <select name="priority" id="priority" class="form-select" required>
        <option value="Low" {{ old('priority', $task->priority ?? '') == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ old('priority', $task->priority ?? '') == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ old('priority', $task->priority ?? '') == 'High' ? 'selected' : '' }}>High</option>
    </select>
    </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
@endsection

