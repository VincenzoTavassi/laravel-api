<table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">
        <a href="{{Request::url()}}?sort=id&order={{$sort == 'id' && $order != 'desc' ? 'desc' : 'asc'}}">#</a>
      @if ($sort == 'id')
              <a href="{{ Request::url() }}?sort=id&order={{ $sort == 'id' && $order != 'desc' ? 'desc' : 'asc' }}">
                <i class="bi bi-arrow-down text-primary fs-5 d-inline-block @if ($order == 'desc')rotate-180 @endif">
                </i>
              </a>
            @endif
      </th>
      <th scope="col">
             <a href="{{Request::url()}}?sort=title&order={{$sort == 'title' && $order != 'desc' ? 'desc' : 'asc'}}">Titolo</a>
      @if ($sort == 'title')
              <a href="{{ Request::url() }}?sort=title&order={{ $sort == 'title' && $order != 'desc' ? 'desc' : 'asc' }}">
                <i class="bi bi-arrow-down text-primary fs-5 d-inline-block @if ($order == 'desc')rotate-180 @endif">
                </i>
              </a>
            @endif
        </th>
      <th scope="col">
                   <a href="{{Request::url()}}?sort=type_id&order={{$sort == 'type_id' && $order != 'desc' ? 'desc' : 'asc'}}">Tipologia</a>
      @if ($sort == 'type_id')
              <a href="{{ Request::url() }}?sort=type_id&order={{ $sort == 'type_id' && $order != 'desc' ? 'desc' : 'asc' }}">
                <i class="bi bi-arrow-down text-primary fs-5 d-inline-block @if ($order == 'desc')rotate-180 @endif">
                </i>
              </a>
            @endif
        </th>
        <th scope="col">Tecnologie</th>
      <th scope="col">
              <a href="{{Request::url()}}?sort=date&order={{$sort == 'date' && $order != 'desc' ? 'desc' : 'asc'}}">Data</a>
      @if ($sort == 'date')
              <a href="{{ Request::url() }}?sort=date&order={{ $sort == 'date' && $order != 'desc' ? 'desc' : 'asc' }}">
                <i class="bi bi-arrow-down text-primary fs-5 d-inline-block @if ($order == 'desc')rotate-180 @endif">
                </i>
              </a>
            @endif
      </th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($projects as $project)
    <tr>
      <th scope="row">{{$project->id}}</th>
      <td>{{$project->title}}</td>
      <td>{!!$project->type?->getBadgeHTML()!!}
      </td>
      <td>@forelse ($project->technologies as $technology) {!! $technology->getBadgeHTML()!!} @empty @endforelse</td>
      <td>{{$project->date}}</td>
      <td>
        <a href="{{$project->link}}" title="Vai al progetto online"><i class="bi bi-link-45deg"></i></a>
        <a href="{{route('projects.show', $project)}}" title="Mostra dettagli del progetto"><i class="bi bi-eye-fill"></i></a>
        <a href="{{route('projects.edit', $project)}}" title="Modifica il progetto"><i class="bi bi-pencil-fill"></i></a>
        <i class="bi bi-trash3-fill text-dark" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-project-id="{{$project->id}}" data-bs-project-title="{{$project->title}}"></i>
    </td>
    </tr>
    @empty
        <h2>Nessun progetto in archivio.</h2>
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
        <form id="delete" action="{{route('projects.destroy', $project)}}" method="POST">
          @csrf @method('DELETE')
          <input type="hidden" name="page" value="{{$projects->currentPage()}}">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-project-id="{{$project->id}}" data-bs-project-title="{{$project->title}}">
          Conferma</button>
</form>
      </div>
    </div>
  </div>
</div>

<script>
const exampleModal = document.getElementById('deleteModal')

console.log(window.location.href)

exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget
  // Estraggo ID e Titolo della canzone selezionata
  const projectID = button.getAttribute('data-bs-project-id')
  const projectTitle = button.getAttribute('data-bs-project-title')
  // Body della modal
  const modalBodyInput = exampleModal.querySelector('.modal-body')
  // Modifico l'action del Form in base all'ID
  const form = document.getElementById('delete')
  form.action = `${window.location.pathname}/${projectID}`;
  modalBodyInput.innerHTML = `Sei sicuro di voler cancellare il progetto <strong>${projectTitle}</strong> con ID <strong>${projectID}</strong>?`
})</script>