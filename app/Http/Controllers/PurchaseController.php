<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category')->get();
        $projects = Project::orderBy('project')->get();
        $purchases = Purchase::with('category')->paginate(10);

        return view('purchases.index', compact('purchases', 'categories', 'projects'));
    }

    public function create()
    {
        $categories = Category::orderBy('category')->get();
        $projects = Project::orderBy('project')->get();

        return view('purchases.add', compact('categories', 'projects'));
    }

    public function store(Request $request)
    {
        $name = preg_replace('/\s+/', '_', $request->name);
        $invoice = $request->file('files');
        $path = "invoices/{$name}.{$invoice->getClientOriginalExtension()}";
        Storage::disk('public')->put($path, file_get_contents($invoice));

        Purchase::create([
            'item' => $request->name,
            'category_id' => $request->category_id,
            'project_id' => $request->project_id,
            'unit_value' => $request->vl_unit,
            'quantity' => $request->quantity,
            'total_value' => floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity,
            'provider' => $request->provider,
            'invoice_key' => $request->invoice_key,
            'invoice_path' => $path,
        ]);

        return redirect('purchases')->with('status', 'Compra adicionada com sucesso.');
    }

    public function download(Purchase $purchase)
    {
        return Storage::download($purchase->invoice_path);
    }

    public function edit(Purchase $purchase)
    {
        $categories = $this->showCategories();
        $projects = $this->showProjects();

        return view('purchases.edit', compact('purchase', 'categories', 'projects'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update([
            'item' => $request->name,
            'category_id' => $request->category_id,
            'project_id' => $request->project_id,
            'unit_value' => $request->vl_unit,
            'quantity' => $request->quantity,
            'total_value' => floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity,
            'provider' => $request->provider,
            'invoice_key' => $request->invoice_key,
        ]);

        return redirect('purchases')->with('status', 'Compra atualizada com sucesso.');
    }

    public function destroy(Purchase $purchase)
    {
        try {
            Storage::delete($purchase->invoice_path);
            $purchase->delete();

            return redirect('purchases')->with('status', 'Compra deletada com sucesso.');
        } catch (\Exception $e) {
            return redirect('purchases')->with('error', $e->getMessage());
        }
    }
}

