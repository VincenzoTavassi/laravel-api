@extends('layouts.app')

@section('content')

  @include('admin.projects._partials.session-messages')

  <div class="container">
    <h2 class="fs-4 text-secondary my-4">
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body container">
                @if($project->id)
                    <h2 class="mb-4">Modifica il progetto</h2>
                    <form action="{{route('projects.update', $project)}}" method="post" class="row" enctype="multipart/form-data">
                    @method('put')
                @else
                    <h2 class="mb-4">Crea un nuovo progetto</h2>
                    <form action="{{route('projects.store')}}" method="post" class="row" enctype="multipart/form-data">
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
                <div class="col-5">
                    <label for="link">Link al progetto</label>
                    <input type="text" name="link" id="link" class="w-100 form-control @error('link') is-invalid @enderror" value="{{old('link', $project->link)}}">
                    @error('link')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="date">Data</label>
                    <input type="date" name="date" id="date" class="w-50 form-control @error('date') is-invalid @enderror" value="{{old('date', $project->date)}}">
                    @error('date')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-9">
                    <label for="type_id" class="my-2">Tipologia progetto</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                    <option value="" selected>Nessuna tipologia</option>
                    @foreach ($types as $type)
                    {{-- Se il valore dell'input della select è uguale al precedente input utente oppure all'id del progetto (in caso di edit), seleziona l'opzione --}}
                    <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{$type->id}}">{{$type->title}}</option>   
                    @endforeach
                    </select>
                    @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-9">
                    <div class="my-2">Tecnologie:</div>
                    <div class="form-check">
                        @foreach ($technologies as $technology)
                    <input 
                    class="form-check-input @error('technologies') is-invalid @enderror"
                    type="checkbox"
                    value="{{$technology->id}}"
                    id="tech-{{$technology->id}}"
                    name="technologies[]"
                    {{-- Se l'id della tecnologia è l'ultimo compilato dall'utente, oppure se è presente l'array
                    delle tecnologie progetto, dai checked. Se non c'è l'array delle tecnologie progetto, indicalo come vuoto --}}
                    @if(in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif
                    >
                    <label class="form-check-label" for="tech-{{$technology->id}}">
                    {{$technology->title}}
                    </label>
                    @endforeach
                    @error('technologies')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                </div>

                <div class="col-9">
                    <label for="description" class="my-2">Descrizione</label>
                    <textarea rows="8" class="w-100 form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description', $project->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-2">
                    @if($project->image)
                    <img src="{{asset('storage/' . $project->image)}}" alt="" width="100%">
                    @elseif($project->link)
                    <img src="{{$project->link}}" alt="" width="100%" class="my-3">
                    @endif
                    <label for="image">Immagine</label>
                    <input type="file" name="image" id="image" class="w-50 form-control @error('image') is-invalid @enderror" value="{{old('image', $project->image)}}">
                    @error('image')
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