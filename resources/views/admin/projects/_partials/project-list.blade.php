<table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titolo</th>
      <th scope="col">Data</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($projects as $project)
    <tr>
      <th scope="row">{{$project->id}}</th>
      <td>{{$project->title}}</td>
      <td>{{$project->date}}</td>
      <td>
        <a href="{{$project->link}}" title="Vai al progetto online"><i class="bi bi-link-45deg"></i></a>
        <a href="{{route('projects.show', $project)}}" title="Mostra dettagli del progetto"><i class="bi bi-eye-fill"></i></a>
    </td>
    </tr>
    @empty
        <h2>Nessun progetto in archivio.</h2>
    @endforelse
  </tbody>
</table>