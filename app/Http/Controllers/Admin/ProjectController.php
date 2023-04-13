<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        // istanzio una variabile vuota da inviare al form per evitare l'errore
        $project = new Project;
        return view('admin.projects.form', compact('project'));
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
        $project = new Project;
        $project->fill($data);
        $project->save();
        return redirect(route('projects.show', $project));
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
        return view('admin.projects.form', compact('project'));
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
        $project->update($data);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Request $request)
    {
        $project->delete();

        // Redirect all'ultima pagina disponibile
        $paginator = Project::paginate(10);
        // Se la pagina del $request è minore uguale all'ultima disponibile OK, altrimenti redirect all'ultima disponibile
        $redirectToPage = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();
        return to_route('projects.index', ['page' => $redirectToPage]);
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
            ],
            [
                'title.*' => 'Il titolo è obbligatorio (massimo 100 caratteri)',

                'link.required' => 'La URL del progetto è obbligatoria',
                'link.url' => 'Il link al progetto deve essere un URL valido',
                'link.max' => 'Massimo 255 caratteri per la URL',

                'description.max' => 'La descrizione può avere massimo 2500 caratteri',

                'date.date' => 'Il formato della data non è corretto',
                'date.required' => 'La data del progetto è obbligatoria'
            ]
        )->validate();
    }
}
