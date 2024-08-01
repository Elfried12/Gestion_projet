@extends('master')
@section('title', "Modification d'un projet")


@section('content')
<style>
    .container{
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
    background-color: black;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
    font-size: 16px;
    text-align: center;
    margin-bottom: 5px;
}

button[type="submit"]:hover {
    background-color: green;
}

input[type="text"]{
    border-radius: 15px;
    border: 1px black solid;
}
input[type="date"]{
    border-radius: 15px;
    border: 1px black solid;
}
</style>
<div class="container">
    <h1>Edit project</h1>

    <form action="{{route('projects.update',$project->id)}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$project->id}}">
        @if(session('projects.index'))
        <div>
            {{(session('etudiants.index'))}}
        </div>
        @endif

        <div>
        <div>
                <label for="name">Nom</label>
                <input id="name" name="name" type="text" required value="{{ old('name',$project->name) }}">
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Description</label>
                <input id="description" name="description" type="text" required value="{{ old('description',$project->description) }}">
            </div>
            
            <div>
                <label for="start_date">Debut</label>
                <input id="start_date" name="start_date" type="date" required value="{{old('start_date',$project->start_date)}}">
            </div>

            <div>
                <label for="end_date">Fin</label>
                <input id="end_date" name="end_date" type="date" required value="{{old('end_date',$project->end_date)}}">
            </div>

            <div>
                <button type="submit">Mettre a jour</button>
            </div>
        </div>
    </form>
</div>
@endsection