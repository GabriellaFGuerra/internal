<?php

namespace App\Http\Controllers;

use App\Models\Blueprint;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlueprintController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('blueprints.index', compact('projects'));
    }

    public function show($id_project, $project_name)
    {
        $project = Project::findOrFail($id_project);
        $blueprints = $project->blueprints;

        return view('blueprints.blueprint', [
            'id_project' => $id_project,
            'project_name' => $project_name,
            'blueprints' => $blueprints,
            'no_blueprint' => $blueprints->isEmpty() ? 'Nenhuma planta vinculada a este projeto.' : null,
        ]);
    }

    public function create($id_project, $project_name)
    {
        return view('blueprints.add', [
            'id_project' => $id_project,
            'project_name' => $project_name,
        ]);
    }

    public function store(Request $request, $id_project, $project_name)
    {
        $request->validate([
            'name' => 'required',
            'files.*' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('files')) {
            $loop = 1;
            foreach ($request->file('files') as $image) {
                $subject = Str::slug($request->name);
                $name = "{$subject}_{$loop}.{$image->getClientOriginalExtension()}";
                $image->storeAs("public/blueprints/{$project_name}", $name);
                Blueprint::create([
                    'blueprint' => $name,
                    'blueprint_path' => "blueprints/{$project_name}/{$name}",
                    'project_id' => $id_project,
                ]);
                $loop++;
            }
        }

        return redirect()->route('blueprint', [
            'id_project' => $id_project,
            'project_name' => $project_name,
        ])->with('status', 'Planta adicionada com sucesso.');
    }

    public function download($id_project, $project_name, $id)
    {
        $blueprint = Blueprint::findOrFail($id);

        return Storage::download("public/{$blueprint->blueprint_path}");
    }

    public function delete($id_project, $project_name, $id)
    {
        $delete = Blueprint::findOrFail($id);
        Storage::delete("public/{$delete->blueprint_path}");
        $delete->delete();

        return redirect()->route('blueprint', [
            'id_project' => $id_project,
            'project_name' => $project_name,
        ])->with('status', 'Planta deletada com sucesso.');
    }
}

