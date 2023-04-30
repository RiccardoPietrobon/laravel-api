<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
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
            $project->image = $project->getImageUri();
        }

        return response()->json(compact('projects'));
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


        $project->image = $project->getImageUri(); //passo la singola immagine


        return response()->json($project); //se c'è dallo buono
    }

    /**
     * Update the specified resource filtered by id_type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectsByType($type_id)
    {
        $projects = Project::where('type_id', $type_id)
            ->where('published', true)
            ->with('type', 'technologies')
            ->orderBy('updated_at', 'DESC')
            ->paginate(6);

        $type = Type::find($type_id);

        foreach ($projects as $project) {
            $project->image = $project->getImageUri();
        }

        return response()->json(compact('projects', 'type'));
    }
}