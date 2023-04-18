@extends('layouts.app')

@section('title', 'Tipologie')

@section('content')
<div class="container">
      @include('admin.projects._partials.session-messages')
    <div class="row justify-content-center">
        <div class="col my-3">
            <div class="d-flex align-items-center">
                <h2 class="fs-4 text-secondary my-4">Lista Tipologie</h2>
                <a href="{{route('types.create')}}" type="button" class="btn btn-dark ms-auto my-3">Nuova Tipologia</a>
            </div>
            <div class="card">
                <div class="card-body">
                    {{-- {{$types->links()}} --}}
<table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Colore</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($types as $type)
    <tr>
      <th scope="row">{{$type->id}}</th>
      <td>{{$type->title}}</td>
      <td><span class="badge rounded-pill" style="background-color:{{$type->color}}">{{$type->color}}</span>
      </td>
      <td>
        <a href="{{route('types.edit', $type)}}" title="Modifica la tipologia"><i class="bi bi-pencil-fill"></i></a>
        <i class="bi bi-trash3-fill text-dark" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-type-id="{{$type->id}}" data-bs-type-title="{{$type->title}}"></i>
    </td>
    </tr>
    @empty
        <h2>Nessuna tipologia in archivio.</h2>
    @endforelse
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma cancellazione</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
Sei sicuro di voler cancellare 
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form id="delete" action="{{route('types.destroy', $type)}}" method="POST">
          @csrf @method('DELETE')
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-type-id="{{$type->id}}" data-bs-type-title="{{$type->title}}">
          Conferma</button>
</form>
      </div>
    </div>
  </div>
</div>



                </div>
            </div>
        </div>
    </div>
</div>
<script>
const exampleModal = document.getElementById('deleteModal')
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget
  // Estraggo ID e Titolo della tipologia selezionata
  const typeID = button.getAttribute('data-bs-type-id')
  const typeTitle = button.getAttribute('data-bs-type-title')
  // Body della modal
  const modalBodyInput = exampleModal.querySelector('.modal-body')
  // Modifico l'action del Form in base all'ID
  const form = document.getElementById('delete')
  form.action = `${window.location.pathname}/${typeID}`;
  modalBodyInput.innerHTML = `Sei sicuro di voler cancellare la tipologia <strong>${typeTitle}</strong> con ID <strong>${typeID}</strong>?`
})</script>
@endsection