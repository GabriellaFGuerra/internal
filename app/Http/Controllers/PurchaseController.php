<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Traits\ProjectTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\CategoryTrait;

class PurchaseController extends Controller
{
    use CategoryTrait;
    use ProjectTrait;

    public function index()
    {

        $categories = $this->showCategories();
        $projects = $this->showProjects();
        $purchases = Purchase::with('category')->paginate(10);
        return view('purchases.index')->with(['purchases' => $purchases, 'categories' => $categories, 'projects' => $projects]);
    }

    public function create()
    {
        $categories = $this->showCategories();
        $projects = $this->showProjects();
        return view('purchases.add', ['categories' => $categories, 'projects' => $projects]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vl_unit' => 'required',
            'quantity' => 'required|int',
            'provider' => 'required',
            'invoice_key' => 'nullable',
            'files' => 'required|file|mimes:png,jpeg,jpg,pdf',
            'project_id' => 'nullable',
            'category_id' => 'nullable',
        ]);

        $subject = preg_replace('/\s+/', '_', $request->name);
        $invoice = $request->file('files');
        $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) . '.' . $invoice->getClientOriginalExtension();
        $path = '/invoices/' . $name;
        Storage::disk('public')->put($path, file_get_contents($invoice));

        $save = new Purchase;

        $save->item = $request->name;
        $save->category_id = $request->category_id;
        $save->project_id = $request->project_id;
        $save->unit_value = $request->vl_unit;
        $save->quantity = $request->quantity;
        $save->total_value = floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity;
        $save->provider = $request->provider;
        $save->invoice_key = $request->invoice_key;
        $save->invoice_path = $path;
        $save->save();

        return redirect('purchases')->with('status', 'Compra adicionada com sucesso.');
    }

    public function download($id)
    {
        $purchase = Purchase::find($id);
        return Storage::download($purchase->invoice_path);
    }

    public function edit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'vl_unit' => 'required',
            'quantity' => 'required|int',
            'provider' => 'required',
            'invoice_key' => 'nullable',
            'invoice' => 'nullable|file|mimes:png,jpeg,jpg,pdf',
            'project_id' => 'nullable',
            'category_id' => 'nullable',
        ]);

        $save = Purchase::find($request->purchase_id);
        if (isset($request->invoice)) {
            $subject = preg_replace('/[^A-Za-z0-9\-]\s+/', '_', $request->name);
            $invoice = $request->file('invoice');
            $name = transliterator_transliterate('Any-Latin; Latin-ASCII', $subject) . '.' . $invoice->getClientOriginalExtension();
            $path = '/invoices/' . $name;
            Storage::disk('public')->put($path, file_get_contents($invoice));
            $save->invoice_path = $path;
        }
        $save->item = $request->name;
        $save->category_id = $request->category_id;
        $save->project_id = $request->project_id;
        $save->unit_value = $request->vl_unit;
        $save->quantity = $request->quantity;
        $save->total_value = floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity;
        $save->provider = $request->provider;
        $save->invoice_key = $request->invoice_key;
        $save->update();
        return redirect('purchases')->with('status', 'Compra atualizada com sucesso.');
    }
}
