@extends('layouts.app')

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <h4>Correggi i seguenti errori per proseguire: </h4>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body container">
                @if($project->id)
                    <h2 class="mb-4">Modifica il progetto</h2>
                    <form action="{{route('projects.update', $project)}}" method="post" class="row">
                    @method('put')
                @else
                    <h2 class="mb-4">Crea un nuovo progetto</h2>
                    <form action="{{route('projects.store')}}" method="post" class="row">
                @endif
                @csrf
                <div class="col-4">
                    <label for="title">Titolo progetto</label>
                    <input type="text" name="title" id="title" class="w-100 form-control @error('title') is-invalid @enderror" value="{{old('title', $project->title)}}">
                    @error('title')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="link">Link al progetto</label>
                    <input type="text" name="link" id="link" class="w-100 form-control @error('link') is-invalid @enderror" value="{{old('link', $project->link)}}">
                    @error('link')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="date">Data</label>
                    <input type="date" name="date" id="date" class="w-50 form-control @error('date') is-invalid @enderror" value="{{old('date', $project->date)}}">
                    @error('date')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-8">
                    <label for="description">Descrizione</label>
                    <textarea class="w-100 form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description', $project->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark my-4">{{$project->id ? 'Modifica Progetto' : 'Crea Progetto'}}</button>
        <a href="{{route('projects.index')}}" class="btn btn-dark my-4">Torna alla Lista</a>
    </form>
        </div>
    </div>
</div>
@endsection