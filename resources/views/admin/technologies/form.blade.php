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
                @if($technology->id)
                    <h2 class="mb-4">Modifica la tecnologia</h2>
                    <form action="{{route('technologies.update', $technology)}}" method="post" class="row" enctype="multipart/form-data">
                    @method('put')
                @else
                    <h2 class="mb-4">Crea una nuova tecnologia</h2>
                    <form action="{{route('technologies.store')}}" method="post" class="row" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="col-4">
                    <label for="title">Nome tecnologia</label>
                    <input type="text" name="title" id="title" class="w-100 form-control @error('title') is-invalid @enderror" value="{{old('title', $technology->title)}}">
                    @error('title')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-9">
                    <label for="color" class="my-2">Colore tecnologia</label>
                    <input type="color" name="color" id="color" value="{{old('color', $technology->color)}}">
                    @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark my-4">{{$technology->id ? 'Modifica' : 'Crea'}}</button>
        <a href="{{route('technologies.index')}}" class="btn btn-dark my-4">Torna alla Lista</a>
    </form>
        </div>
    </div>
</div>
@endsection