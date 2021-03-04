<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\CategoryTrait;

class PurchaseController extends Controller
{
    use CategoryTrait;

    public function index()
    {

        $categories = $this->showCategories();
        $purchases = Purchase::with('category')->get();
        return view('purchases.index')->with('purchases', $purchases)->with('categories', $categories);

    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vl_unit' => 'required',
            'quantity' => 'required|int',
            'provider' => 'required',
            'invoice_key' => 'nullable',
            'invoice' => 'required|file|mimes:png,jpeg,jpg,pdf',
            'project_id' => 'nullable',
            'category_id' => 'nullable',
        ]);

        $name = $request->name;
        $path = public_path() . '/invoices/';
        $invoicename = $name . '.' . $request->file('invoice')->extension();

        if ($request->file('invoice')->storeAs($path, $invoicename)) {
            $save = new Purchase;

            $save->item = $name;
            $save->category_id = $request->category_id;
            $save->project_id = $request->project_id;
            $save->unit_value = $request->vl_unit;
            $save->quantity = $request->quantity;
            $save->total_value = floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity;
            $save->provider = $request->provider;
            $save->invoice_key = $request->invoice_key;
            $save->invoice_path = $path . $invoicename;
            $save->save();
            return redirect('purchases')->with('status', 'Compra adicionada com sucesso.');
        }
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
            'invoice' => 'nullable|file|mimes:png,jpeg,jpg,pdf',
            'project_id' => 'nullable',
            'category_id' => 'nullable',
        ]);

        $save = Purchase::find($request->purchase_id);
        if (isset($request->invoice)) {
            if ($request->file('invoice')->storeAs($path, $invoicename)) {
                $name = $request->name;
                $path = public_path() . '/invoices/';
                $invoicename = $name . '.' . $request->file('invoice')->extension();
                $save->invoice_path = $path . $invoicename;
            }
        }
        $save->item = $request->name;
        $save->category_id = $request->category_id;
        $save->project_id = $request->project_id;
        $save->unit_value = $request->vl_unit;
        $save->quantity = $request->quantity;
        $save->total_value = floatval(str_replace(',', '.', $request->vl_unit)) * $request->quantity;
        $save->provider = $request->provider;
        $save->update();
        return redirect('purchases')->with('status', 'Compra atualizada com sucesso.');


    }
}
