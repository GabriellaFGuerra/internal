<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;


class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index')->with('documents', $documents);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'document' => 'required|file|mimes:csv,txt,xlx,xls,pdf,docx,pdf',
            'project_id' => 'nullable'
        ]);

        $name = $request->name;
        $path = public_path() . '/documents/';
        $docname = $name . '.' . $request->file('document')->extension();

        if ($request->file('document')->storeAs($path, $docname)) {
            $save = new Document;

            $save->document_name = $name;
            $save->document_path = $path . $docname;
            $save->project_id = $request->project_id;
            $save->save();
            return redirect('documents')->with('status', 'Documento adicionado com sucesso.');
        }
    }

    public function download($id)
    {
        $doc = Document::find($id);
        return Storage::download($doc->document_path);
    }

    public function delete($id) {
        $doc = Document::find($id);
        $doc->delete();
        return back()->with('status', 'Arquivo deletado com sucesso.');

    }

    public function trash() {
        $documents = Document::onlyTrashed()->get();
        return view('documents.trash')->with('documents', $documents);
    }

    public function restore($id) {
        $doc = Document::onlyTrashed()->find($id);
        $doc->restore();
        return back()->with('status', 'Arquivo restaurado com sucesso.');
    }

    public function permadelete($id) {
        $doc = Document::onlyTrashed()->find($id);
        Storage::delete($doc->document_path);
        $doc->forceDelete();
        return back()->with('status', 'Arquivo deletado permanentemente com sucesso.');
    }
}

