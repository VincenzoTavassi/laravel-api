@extends('layouts.app')

@section('title', 'Lista Progetti')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col my-3">
            <div class="d-flex align-items-center">
                <h2 class="fs-4 text-secondary my-4">Lista Progetti</h2>
                <a href="{{route('projects.create')}}" type="button" class="btn btn-dark ms-auto my-3">Nuovo progetto</a>
            </div>
            <div class="card">
                <div class="card-body">
                    @include('admin.projects._partials.project-list')
                    {{$projects->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection