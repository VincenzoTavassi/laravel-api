<div class="row row-cols-4">
    @foreach ($projects as $project)
    <div class="col my-2">
        <div class="card h-100">
            <img src="{{$project->image ? asset('storage/' . $project->image) : $project->link}}" class="card-img-top" alt="{{$project->title}}">
            <div class="card-body d-flex flex-column align-items-center">
                <h5 class="card-title">{{$project->title}}</h5>
                <p><strong>Tipo: </strong><span class="badge rounded-pill" style="background-color:{{$project->type?->color}}">{{$project->type?->title}}</span></p>
                <p class="card-text">{{$project->description}}</p>
                <p><strong>Tecnologie: </strong>
                        @forelse ($project->technologies as $technology) 
                        <span class="badge" style="background-color:{{$technology->color}}">{{$technology->title}}</span>
                        @empty ''
                        @endforelse
                    </p>
                <a href="{{route('guest.show', $project)}}" class="btn btn-dark mt-auto">Dettagli</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{$projects->links()}}