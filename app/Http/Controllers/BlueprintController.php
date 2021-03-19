<?php

namespace App\Http\Controllers;

use App\Models\Blueprint;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlueprintController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('blueprints.index')->with(['projects' => $projects]);
    }

    public function show($id_project, $project_name)
    {
        $projects = Project::all();
        $project = $projects->find($id_project);
        $blueprints = $project->blueprints()->where('project_id', $id_project)->get();

        if ($blueprints->isEmpty()) {
            return view('blueprints.blueprint', ['id_project' => $id_project, 'project_name' => $project_name, 'blueprints' => $blueprints, 'no_blueprint' => 'Nenhuma planta vinculada a este projeto.']);
        } else {
            return view('blueprints.blueprint', ['id_project' => $id_project, 'project_name' => $project_name, 'blueprints' => $blueprints]);
        }
    }

    public function upload($id_project, $project_name, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'blueprint' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $blueprint = $request->file('blueprint');
        $subject = preg_replace('/[^A-Za-z0-9\-]\s+/', '_', $request->name);
        $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) . '.' . $blueprint->getClientOriginalExtension();
        $path = '/blueprints/' . $project_name . '/' . $name;
        Storage::disk('public')->put($path, file_get_contents($blueprint));
        $save = new Blueprint;
        $save->blueprint = $name;
        $save->blueprint_path = $path;
        $save->project_id = $id_project;
        $save->save();
        return redirect()->route('blueprint', ['id_project' => $id_project, 'project_name' => $project_name])->with('status', 'Planta adicionada com sucesso.');
    }

    public function download($id_project, $project_name, $id)
    {
        $blueprint = Blueprint::find($id);
        return Storage::download($blueprint->blueprint_path);
    }
}
