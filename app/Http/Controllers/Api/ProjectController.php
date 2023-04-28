<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('published', true)->with('type', 'technologies')->orderBy('updated_at', 'DESC')->paginate(6);

        foreach ($projects as $project) {
            // $project->text = $project->getAbstract(100); //faccio passare l'abstract invece del testo intero
            // if ($project->image) $project->image = url('storage/' . $project->image);
            if ($project->image) $project->image = $project->getImageUri();
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)

    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first(); //prendi il progetto

        if (!$project) return response(null, 404); //se non c'è errore

        return response()->json($project); //se c'è dallo buono
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}