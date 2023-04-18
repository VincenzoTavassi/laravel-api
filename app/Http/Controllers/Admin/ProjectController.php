<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::Paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project; // istanzio una variabile vuota da inviare al form per evitare l'errore
        $types = Type::orderBy('title')->get(); // Recupero tutti i tipi disponibili in ordine alfabetico per inviarli alla select
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        if (Arr::exists($data, 'image')) { // Se c'è un'immagine nell'array $data
            $path = Storage::put('uploads', $data['image']); // Ottieni il path e salvala nella cartella uploads
            $data['image'] = $path; // Il dato da salvare in db diventa il path dell'immagine
        }
        $project = new Project;
        $project->fill($data); // Fillable da inserire nel model
        $project->save();
        return to_route('projects.show', $project)->with('message', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('title')->get(); // Recupero tutti i tipi disponibili per inviarli alla select
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all());
        if (Arr::exists($data, 'image')) { // Se c'è un'immagine nell'array $data
            if ($project->image) {
                Storage::delete($project->image); // Elimina la vecchia immagine se presente
            }
            $path = Storage::put('uploads', $data['image']); // Ottieni il path della nuova e salvala nella cartella uploads
            $data['image'] = $path; // Il dato da salvare in db diventa il path dell'immagine

        }
        $project->update($data);
        return to_route('projects.show', compact('project'))->with('message', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Request $request)
    {
        if ($project->image) { // Se c'è un'immagine eliminala
            Storage::delete($project->image);
        }
        $project->delete();

        // Redirect all'ultima pagina disponibile
        $paginator = Project::paginate(10);
        // Se la pagina del $request è minore uguale all'ultima disponibile OK, altrimenti redirect all'ultima disponibile
        $redirectToPage = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();
        return to_route('projects.index', ['page' => $redirectToPage])->with('message', 'Progetto eliminato con successo!');
    }


    private function validation($data)
    {

        return Validator::make(

            $data,
            [
                'title' => 'required|max:100',
                'link' => 'required|url|max:255',
                'description' => 'nullable|max:2500',
                'date' => 'date|required',
                'image' => 'nullable|image|mimes:jpg,jpeg,bmp,png',
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'title.*' => 'Il titolo è obbligatorio (massimo 100 caratteri)',

                'link.required' => 'La URL del progetto è obbligatoria',
                'link.url' => 'Il link al progetto deve essere un URL valido',
                'link.max' => 'Massimo 255 caratteri per la URL',

                'description.max' => 'La descrizione può avere massimo 2500 caratteri',

                'date.date' => 'Il formato della data non è corretto',
                'date.required' => 'La data del progetto è obbligatoria',

                'image.image' => 'Il file deve essere un\'immagine',
                'image.mimes' => 'Estensioni ammesse: .jpg, .jpeg, .bmp, .png',

                'type_id.exists' => 'Il tipo di progetto selezionato non esiste'
            ]
        )->validate();
    }
}
