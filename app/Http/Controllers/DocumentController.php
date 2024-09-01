<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::paginate(10);
        $projects = Project::all();
        return view('documents.index', compact('documents', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('documents.add', compact('projects'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'files' => ['required', 'file', 'mimes:csv,txt,xlx,xls,pdf,docx'],
            'project_id' => ['required', Rule::exists(Project::class, 'id')],
        ]);

        $project = Project::findOrFail($request->project_id);

        $doc = $request->file('files');
        $subject = preg_replace('/[^A-Za-z0-9\-]\s+/', '_', $request->name);
        $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) . '.' . $doc->getClientOriginalExtension();
        $path = 'documents/' . $project->project . '/' . $name;
        Storage::disk('public')->put($path, file_get_contents($doc));
        Document::create([
            'document_name' => $name,
            'document_path' => $path,
            'project_id' => $project->id,
        ]);
        return redirect('documents')->with('status', 'Documento adicionado com sucesso.');
    }

    public function download(Document $document)
    {
        return Storage::download('public/' . $document->document_path);
    }

    public function delete(Document $document)
    {
        $document->delete();
        return back()->with('status', 'Arquivo deletado com sucesso.');
    }

    public function trash()
    {
        $documents = Document::onlyTrashed()->get();
        return view('documents.trash', compact('documents'));
    }

    public function restore(Document $document)
    {
        $document->restore();
        return back()->with('status', 'Arquivo restaurado com sucesso.');
    }

    public function permadelete(Document $document)
    {
        Storage::delete($document->document_path);
        $document->forceDelete();
        return back()->with('status', 'Arquivo deletado permanentemente com sucesso.');
    }
}

