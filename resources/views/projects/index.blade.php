@extends('master')
@section('title', "Liste des projets")

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .header h2 {
        margin: 0;
    }
    .btn-primary {
        background-color: black;
        border: none;
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
    }
    .btn-primary i {
        margin-right: 5px;
    }
    .projects-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .project-card {
        background-color: whitesmoke;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 20px;
    }
    .project-card h3 {
        margin-top: 0;
    }

    .project-actions {
        margin-top: 10px;
        display: flex;
        gap: 10px;
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
    }

    .btn-secondary, .btn-warning, .btn-info, .btn-danger {
        display: inline-flex;
        align-items: center;
    }
</style>

<div class="container mt-5">
    <div class="header">
        <h2>Projects List</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary add-project-btn">
            <button>Add Project</button>
        </a>
    </div>
    <div class="projects-list">
        @foreach ($projects as $project)
            <div class="project-card">
                <h3 class="project-name">{{ $project->name }}</h3>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</p>
                <p><strong>Duration:</strong> 
                    {{ \Carbon\Carbon::parse($project->start_date)->diffInDays(\Carbon\Carbon::parse($project->end_date)) }} days
                </p>
                <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($project->description, 100) }} 
                    @if(strlen($project->description) > 100)
                        <button class="btn btn-info btn-sm" onclick="openModal('{{ $project->id }}')">
                            <img src="{{ asset('add2.png') }}" alt="View Description" style="width: 20px; height: 20px; margin-right: 5px;">
                            View More
                        </button>
                    @endif
                </p>

                <a href="{{ route('projects.showTasks', $project->id) }}" class="btn btn-primary">
                <!-- Bouton pour dérouler les tâches -->
                    <button class="btn btn-secondary btn-sm toggle-tasks-btn" onclick="toggleTasks('{{ $project->id }}')">
                        Show Tasks
                    </button>
                </a>
                <!-- Affichage des tâches -->
                <div id="tasks-{{ $project->id }}" class="tasks-list" style="display: none;">
                    <h4>Tasks</h4>
                    @if ($project->tasks->isEmpty())
                        <p>No tasks available for this project.</p>
                    @else
                        <ul>
                            @foreach ($project->tasks as $task)
                                <li>
                                    <strong>{{ $task->title }}</strong> - {{ $task->status }}
                                    <p>{{ $task->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="project-actions">
                    <div>
                        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-secondary">
                        <img src="{{ asset('add.png') }}" alt="Add Task" style="width: 20px; height: 20px; margin-right: 5px;">
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">
                            <img src="{{ asset('edit.png') }}" alt="Edit Project" style="width: 20px; height: 20px; margin-right: 5px;">
                        </a>
                    </div>

                    <div>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
        @endforeach
    </div>
</div>
@endsection