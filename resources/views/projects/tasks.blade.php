@extends('master')
@section('title', "ShowTask")

@section('content')

<style>
    .container {
            max-width: 800px;
            margin: 20px auto;
        }

        .task-table {
            margin-top: 20px;
        }

        .filter-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .filter-button:hover {
            background-color: #0056b3;
        }

        
    table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: white;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 15px;
        border: 2px solid #ddd;
        text-align: center;
        font-size: 14px;
        color: white;
    }

    table th {
        background-color: blanchedalmond;
        color: green;
        font-weight: bold;
        text-transform: uppercase;
    }

    table td {
        background-color: maroon;
    }

    .actions {
        white-space: nowrap;
    }

    .actions a,
    .actions button {
        margin-right: 5px;
        padding: 8px 12px;
        text-decoration: none;
        color: blueviolet;
        border: none;
        cursor: pointer;
        border-radius: 20px;
        transition: background-color 0.3s ease;
        font-size: 13px;
    }

    .actions a.edit {
        background-color: blue;
    }

    .actions a.edit:hover {
        background-color: #218838;
    }

    .actions button.delete {
        background-color: blueviolet;
    }

    .actions button.delete:hover {
        background-color: #c82333;
    }
    
</style>


<div class="container">
        <h1>Tasks for Project: {{ $project->name }}</h1>

        <div class="task-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to All Projects</a>
    </div>