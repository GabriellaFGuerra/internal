<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\Image;
use App\Models\Project;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $users = User::all();
        $projects = Project::with('user')->get();
        return view('projects.index', compact('users', 'projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('projects.add', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:8'],
            'district' => ['required', 'string', 'max:255'],
            'stage' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', Rule::exists(User::class, 'id')],
        ]);

        $project = Project::create([
            'project' => preg_replace('/\s+/', '_', strtolower($request->project)),
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'district' => $request->district,
            'stage' => $request->stage,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('projects')->with('status', 'Projeto criado com sucesso.');
    }

    public function show($id, $name)
    {
        $project = Project::where('id', $id)->with('blueprints', 'documents')->first();
        $purchases = Purchase::where('project_id', $id)->paginate(10);

        if (!$project) {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }

        return view('projects.project', compact('project', 'purchases', 'name'));
    }

    public function createEntry($id, $name)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }

        return view('diary.newentry', compact('project', 'id', 'name'));
    }

    public function storeEntry($id, $name, Request $request)
    {
        $request->validate([
            'entry_text' => ['required', 'string'],
            'files.*' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);

        $project = Project::where('id', $id)->first();
        $entry = Diary::create([
            'entry_text' => $request->entry_text,
            'entry_datetime' => Carbon::now(),
            'project_id' => $project->id,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $imagename = str_replace(' ', '_', $project->project . '_entry_' . $entry->id . '_' . Carbon::now()->format('d-m-Y_H-i-s') . '_image_' . $image->getClientOriginalName());
                Storage::disk('public')->put('/images/' . $imagename, file_get_contents($image));
                $image = Image::create([
                    'image_name' => $imagename,
                    'image_path' => 'images/' . $imagename,
                    'entry_id' => $entry->id,
                ]);
            }
        }

        return redirect()->route('project', ['id' => $id, 'name' => $name])->with('status', 'Entrada adicionada com sucesso.');
    }

    public function readEntry($id, $name, $entry_id)
    {
        $project = Project::where('id', $id)->first();
        $entry = Diary::where('id', $entry_id)->first();

        if (!$project || !$entry) {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto ou entrada não encontrado.']);
        }

        $images = Image::where('entry_id', $entry->id)->get();

        return view('diary.read', compact('project', 'entry', 'images', 'name', 'id'));
    }

    public function editEntry($id, $name, $entry)
    {
        $project = Project::where('id', $id)->first();
        $entry = Diary::where('id', $entry)->where('project_id', $project->id)->first();

        if (!$project || !$entry) {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto ou entrada não encontrado.']);
        }

        return view('diary.editentry', compact('project', 'entry', 'id', 'name'));
    }

    public function updateEntry($id, $name, $entry, Request $request)
    {
        $request->validate([
            'entry_text' => ['required', 'string'],
            'files.*' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);

        $project = Project::where('id', $id)->first();
        $entry = Diary::where('id', $entry)->where('project_id', $project->id)->first();

        $entry->entry_text = $request->entry_text;
        $entry->entry_datetime = Carbon::now();
        $entry->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $imagename = str_replace(' ', '_', $project->project . '_entry_' . $entry->id . '_' . Carbon::now()->format('d-m-Y_H-i-s') . '_image_' . $image->getClientOriginalName());
                Storage::disk('public')->put('/images/' . $imagename, file_get_contents($image));
                $image = Image::create([
                    'image_name' => $imagename,
                    'image_path' => 'images/' . $imagename,
                    'entry_id' => $entry->id,
                ]);
            }
        }

        return redirect()->route('project', ['id' => $id, 'name' => $name])->with('status', 'Entrada editada com sucesso.');
    }

    public function downloadImage($id, $name, $entry, $id_image)
    {
        $image = Image::find($id_image);
        return Storage::download('public/' . $image->image_path);
    }

    public function deleteImage($id, $name, $entry, $id_image)
    {
        $image = Image::find($id_image);
        Storage::delete($image->image_path);
        $image->delete();
        return redirect()->route('readEntry', ['id' => $id, 'name' => $name, 'entry_id' => $entry])->with('status', 'Imagem deletada com sucesso.');
    }

    public function delete($id)
    {
        $project = Project::find($id);

        if ($project->user_id != Auth::user()->id) {
            return redirect()->route('projects')->with('error', 'Você não tem permissão para deletar este projeto.');
        }

        $project->delete();
        return redirect()->route('projects')->with('status', 'Projeto deletado com sucesso.');
    }
}

