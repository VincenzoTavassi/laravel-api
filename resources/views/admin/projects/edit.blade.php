@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">{{$project->title}}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body container">
                    <form action="{{route('projects.update', $project)}}" method="post" class="row">
                        @csrf
                        @method('put')
                        <div class="col-4">
                    <label for="title">Titolo progetto</label>
                    <input type="text" name="title" id="title" class="w-100" value="{{$project->title}}">
                </div>
                <div class="col-4">
                    <label for="link">Link al progetto</label>
                    <input type="text" name="link" id="link" class="w-100" value="{{$project->link}}">
                </div>
                <div class="col-4">
                    <label for="date">Data</label>
                    <input type="date" name="date" id="date" class="w-50" value="{{$project->date}}">
                </div>
                <div class="col-8">
                    <label for="description">Descrizione</label>
                    <textarea class="w-100" name="description" id="description">{{$project->description}}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark my-4">Modifica Progetto</button>
        <a href="{{route('projects.index')}}" class="btn btn-dark my-4">Torna alla Lista</a>
    </form>
        </div>
    </div>
</div>
@endsection