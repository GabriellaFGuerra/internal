<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\Image;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $users = User::all();
        $projects = Project::with('user')->get();
        return view('projects.index')->with(['users' => $users, 'projects' => $projects]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'district' => 'required',
            'stage' => 'required',
            'user_id' => 'required'
        ]);

        $save = new Project;
        $save->project = preg_replace('/\s+/', '_', strtolower($request->project));
        $save->address = $request->address;
        $save->zipcode = $request->zipcode;
        $save->district = $request->district;
        $save->stage = $request->stage;
        $save->user_id = $request->user_id;
        $save->save();

        return view('projects.index')->with(['users' => User::all(), 'projects' => Project::all(), 'status' => 'Projeto criado com sucesso.']);
    }

    public function show($id, $name)
    {
        $info = Project::where('id', $id)->with(['documents', 'purchases', 'diaries', 'blueprints'])->first();
        if ($info) {
            return view('projects.project', ['name' => $name, 'project' => $info]);
        } else {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }

    }

    public function readEntry($id, $name, $entry_id)
    {
        $info = Project::where('id', $id)->first();
        if ($info) {
            $entry_read = Diary::where('id', $entry_id)->first();
            $images = Image::where('entry_id', $entry_read->id)->get();
            return view('diary.read', ['id' => $id, 'name' => $name, 'project' => $info, 'diary' => $entry_read, 'images' => $images]);
        } else {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }
    }

    public function showImage($image_id)
    {
        $img_get = Image::find($image_id);
        return Storage::get($img_get->image_path);
    }

    public function newEntryIndex($id, $name)
    {
        $info = Project::where('id', $id)->first();
        if ($info) {
            return view('diary.newentry', ['id' => $id, 'name' => $name, 'project' => $info]);
        } else {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }
    }

    public function newEntryCreate($id, $name, Request $request)
    {
        $request->validate([
            'entry_text' => 'required',
            'images.*' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $project = Project::where('id', $id)->first();
        $save_entry = new Diary;

        $save_entry->entry_datetime = Carbon::now();
        $save_entry->entry_text = $request->entry_text;
        $save_entry->project_id = $project->id;
        $save_entry->save();

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $imagename = str_replace(' ', '_', $project->project . '_entry_' . $save_entry->id . '_' . Carbon::now()->format('d-m-Y_H-i-s') . '_image_' . $image->getClientOriginalName());
                Storage::disk('public')->put('/images/' . $imagename, file_get_contents($image));
                $save_image = new Image;
                $save_image->image_name = $imagename;
                $save_image->image_path = 'images/' . $imagename;
                $save_image->entry_id = $save_entry->id;
                $save_image->save();
            }
        }

        return redirect()->route('project', ['id' => $id, 'name' => $name])->with(['status' => 'Entrada adicionada com sucesso.']);

    }

    public function entryEditIndex($id, $name, $entry)
    {
        $p = Project::where('id', $id)->first();
        $e = Diary::where('id', $entry)->where('project_id', $p->id)->first();

        if ($e) {
            return view('diary.editentry', ['id' => $id, 'name' => $name, 'entry' => $entry, 'data' => $e]);
        } else {
            return redirect()->route('projects')->withErrors(['error' => 'Projeto não encontrado.']);
        }
    }
}