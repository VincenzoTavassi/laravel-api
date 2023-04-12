<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class GuestProjectsController extends Controller
{
    public function index()
    {

        $projects = Project::Paginate(8);
        return view('guest.home', compact('projects'));
    }

    public function show(Project $project)
    {

        return view('guest.show', compact('project'));
    }
}
