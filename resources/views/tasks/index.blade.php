@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <h3 class="mb-3 mb-md-0">My Tasks</h3>

                <div class="d-flex flex-wrap gap-2">
                    <form method="GET" action="{{ route('tasks.index') }}" class="d-flex">
                        <select name="status" class="form-select me-2" onchange="this.form.submit()">
                            <option value="">Filter by Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>   

                        <select name="priority" class="form-select" onchange="this.form.submit()">
                        <option value="">Filter by Priority</option>
                        <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                        </select>
                        <input type="date" name="due_date" value="{{ request('due_date') }}" class="form-control" onchange="this.form.submit()" />

                        <input
                          type="text"
                          name="search"
                          value="{{ request('search') }}"
                          class="form-control"
                          placeholder="Search tasks..."
                          onkeydown="if(event.key === 'Enter') this.form.submit()"
                          style="min-width: 200px;"
                        />
                    </form>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
                </div>
            </div>

            @if($tasks->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks->unique('id') as $task)
                                <tr>
                                    <td class="text-start fw-semibold">{{ $task->title }}</td>
                                    <td class="text-start">{{ $task->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ 
                                            $task->status === 'completed' ? 'success' : 
                                            ($task->status === 'in_progress' ? 'warning' : 'danger') 
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center flex-wrap">
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>

                                            @if($task->status !== 'completed')
                                                <form action="{{ route('tasks.markCompleted', $task) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-outline-success">Complete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center">No tasks found.</p>
            @endif

        </div>
    </div>
</div>
@endsection
