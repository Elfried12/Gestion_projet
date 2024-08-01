@extends('master')
@section('title', "modification d'une tache")

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
            font-family: interface;
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

        input[type="text"], select, input[type="date"] {
            border-radius: 15px;
            border: 1px black solid;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
<div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $task->id }}">

            @if(session('tasks.index'))
                <div>
                    {{ session('tasks.index') }}
                </div>
            @endif


            <div>
                <label for="title">Title</label>
                <input id="title" name="title" type="text" required value="{{ old('title', $task->title) }}">
                @error('title')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description">Description</label>
                <input id="description" name="description" type="text" required value="{{ old('description', $task->description) }}">
            </div>
            
            <div>
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <button type="submit">Update Task</button>
            </div>
        </form>
    </div>