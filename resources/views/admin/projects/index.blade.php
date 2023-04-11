@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">Lista Progetti</h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @include('admin.projects._partials.project-list')
                    {{$projects->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection