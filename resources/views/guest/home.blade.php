@extends('layouts.guest')
@section('content')

<div class="jumbotron p-5 mb-4 rounded-3">
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-3 @guest text-white @endguest">
            Portfolio Progetti
        </h1>

        @include('guest.partials.projects')

    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection