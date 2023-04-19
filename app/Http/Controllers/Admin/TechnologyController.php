<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technology = new Technology;
        return view('admin.technologies.form', compact('technology'));
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
        $type = new Technology;
        $type->fill($data);
        $type->save();
        return to_route('technologies.index')->with('message', 'Tecnologia creata');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $this->validation($request->all());
        $technology->update($data);
        return to_route('technologies.index')->with('message', 'Tecnologia aggiornata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('technologies.index')->with('message', 'Tecnologia rimossa con successo');
    }

    private function validation($data)
    {

        return Validator::make(
            $data,
            [
                'color' => 'required|string|size:7',
                'title' => 'required|string|max:20',
            ],
            [
                'color.*' => 'Il colore è obbligatorio, tipo hexColor (massimo 7 caratteri)',
                'title.*' => 'Il titolo è obbligatorio, massimo 20 caratteri'
            ]
        )->validate();
    }
}
