@extends('master')
@section('title', "Création d'une tache")

@section('content')
<style>
        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Inter', sans-serif;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            text-align: center;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="text"], input[type="date"], textarea, select {
            border-radius: 15px;
            border: 1px solid black;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }
    </style>

<div class="container mt-5">
    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="project_id">Project</label>
            <select id="project_id" name="project_id" class="form-control" required>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
            @error('title')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input id="description" name="description" type="text" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
</div>
@endsection