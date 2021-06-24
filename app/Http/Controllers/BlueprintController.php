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

    public function create($id_project, $project_name)
    {
        return view('blueprints.add', ['id_project' => $id_project, 'project_name' => $project_name]);
    }

    public function store($id_project, $project_name, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'files.*' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        if ($request->hasFile('files')) {
            $loop = 0;
            foreach ($request->file('files') as $image) {
                $subject = preg_replace('/[^A-Za-z0-9\-]\s+/', '_', $request->name);
                $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) .  '_' . $loop++ . '.' . $image->getClientOriginalExtension();
                $path = '/blueprints/' . $project_name . '/' . $name;
                Storage::disk('public')->put($path, file_get_contents($image));
                $save = new Blueprint;
                $save->blueprint = $name;
                $save->blueprint_path = $path;
                $save->project_id = $id_project;
                $save->save();
            }
        }
        return redirect()->route('blueprint', ['id_project' => $id_project, 'project_name' => $project_name])->with('status', 'Planta adicionada com sucesso.');
    }

    public function download($id_project, $project_name, $id)
    {
        $blueprint = Blueprint::find($id);
        return Storage::download('public/' . $blueprint->blueprint_path);
    }

    public function delete($id_project, $project_name, $id)
    {
        $delete = Blueprint::find($id);
        $delete->delete();
        return redirect()->route('blueprint', ['id_project' => $id_project, 'project_name' => $project_name])->with('status', 'Planta deletada com sucesso.');
    }
}
