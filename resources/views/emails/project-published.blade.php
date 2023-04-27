<x-mail::message>
# Progetto: {{$project->title}}
 
Il progetto è stato pubblicato!

<strong>Data</strong>: {{$project->date}}<br>
<strong>Contenuto</strong>: {{$project->description}}<br>
<strong>Link</strong>: {{$project->link}}<br>
 
<x-mail::button :url="$project->link">
Apri il progetto
</x-mail::button>
 
A presto,<br>
{{ config('app.name') }}
</x-mail::message>

{{-- <h1>Progetto pubblicato</h1>

Il progetto {{$project->title}} è stato pubblicato.
<hr>
<strong>Data</strong>:{{$project->date}}
<hr>
<strong>Contenuto</strong>: {{$project->description}}
<hr>
<strong>Link</strong>:{{$project->link}} --}}