<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::paginate(10);
        $projects = Project::all();
        return view('documents.index', ['documents' => $documents, 'projects' => $projects]);
    }

    public function create()
    {
        $projects = Project::all();
        return view('documents.add', ['projects' => $projects]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'files' => 'required|file|mimes:csv,txt,xlx,xls,pdf,docx,pdf',
            'project_id' => 'required'
        ]);

        $project = Project::find($request->project_id);

        $doc = $request->file('files');
        $subject = preg_replace('/[^A-Za-z0-9\-]\s+/', '_', $request->name);
        $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) . '.' . $doc->getClientOriginalExtension();
        $path = '/documents/' . $project->project . '/' . $name;
        Storage::disk('public')->put($path, file_get_contents($doc));
        $save = new Document;

        $save->document_name = $name;
        $save->document_path = $path;
        $save->project_id = $project->id;
        $save->save();
        return redirect('documents')->with('status', 'Documento adicionado com sucesso.');
    }

    public function download($id)
    {
        $doc = Document::find($id);
        return Storage::download($doc->document_path);
    }

    public function delete($id)
    {
        $doc = Document::find($id);
        $doc->delete();
        return back()->with('status', 'Arquivo deletado com sucesso.');
    }

    public function trash()
    {
        $documents = Document::onlyTrashed()->get();
        return view('documents.trash')->with('documents', $documents);
    }

    public function restore($id)
    {
        $doc = Document::onlyTrashed()->find($id);
        $doc->restore();
        return back()->with('status', 'Arquivo restaurado com sucesso.');
    }

    public function permadelete($id)
    {
        $doc = Document::onlyTrashed()->find($id);
        Storage::delete($doc->document_path);
        $doc->forceDelete();
        return back()->with('status', 'Arquivo deletado permanentemente com sucesso.');
    }
}
