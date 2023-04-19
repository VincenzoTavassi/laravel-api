@extends('layouts.app')

@section('content')

<div class="container">
  @include('admin.projects._partials.session-messages')
    <h2 class="fs-4 text-secondary my-4">
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h2>{{$project->title}}</h2>
                    <img src="{{$project->image ? asset('storage/' . $project->image) : $project->link}}" alt="{{$project->title}}" width="30%" class="float-end ms-3">
                    <p><strong>id: </strong>{{$project->id}}</p>
                    <p><strong>Tipologia: </strong>
                        {!!$project->type?->getBadgeHTML()!!}
                    </p>
                    <p><strong>Tecnologie: </strong>
                        @forelse ($project->technologies as $technology) 
                        {!!$technology->getBadgeHTML()!!}
                        @empty ''
                        @endforelse
                    </p>
                    <p><strong>Titolo: </strong>{{$project->title}}</p>
                    <p><strong>Link: </strong><a href="{{$project->link}}">{{$project->title}}</a></p>
                    <p>{{$project->description}}</p>
                    <p><strong>Progetto del {{$project->date}}</strong></p>
                </div>
            </div>
            <a href="{{route('projects.index')}}" class="btn btn-dark my-4">Torna alla Lista</a>
        </div>
    </div>
</div>
@endsection