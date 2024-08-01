@extends('master')
@section('title', "Liste des taches")

@section('content')
<style>

    .container {
    max-width: 800px;
    margin: 0 auto;
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

    
.search-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.search-bar input[type="text"],
.search-bar select {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;
    width: 300px;
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


        .filter-form {
            margin-bottom: 20px;
        }

        .filter-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        } 

        .form-control {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        margin-bottom: 10px;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

<div class="container">
    <h1>Tasks</h1>
    
    <form method="GET" action="{{ route('tasks.index') }}" class="filter-form">
            <div class="form-group">
                <label for="status">Filter by Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Filter by Project</label>
                <select id="project_id" name="project_id" class="form-control">
                    <option value="">Select Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="filter-btn">Filter</button>
        </form>
    
    <table class="table">
        <thead>
            <tr>
                
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Project</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->project->name }}</td>
                    <td class="actions">
                        
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                                <img src="{{ asset('edit.png') }}" alt="Edit Project" style="width: 20px; height: 20px; margin-right: 5px;">
                            </a>
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