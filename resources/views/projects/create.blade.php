@extends('master')
@section('title', "Création d'un projet")

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
    <h1>PROJECT FORM</h1>

    <form action="{{ route('projects.store')}}" method="POST">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <input id="description" name="description" type="text" required value="{{ old('description') }}">
        </div>
        
        <div>
            <label for="start_date">Debut</label>
            <input id="start_date" name="start_date" type="date" required value="{{old('start_date')}}">
        </div>

        <div>
            <label for="end_date">Fin</label>
            <input id="end_date" name="end_date" type="date" required value="{{old('end_date')}}">
        </div>

        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>
@endsection