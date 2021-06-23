<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use CategoryTrait;

    public function index()
    {
        $categories = $this->showCategories();
        $stocks = Stock::with('category')->paginate(10);
        return view('stock.index')->with('stocks', $stocks)->with('categories', $categories);

    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'withdrawn' => 'required|nullable|date',
            'returned' => 'required|nullable|date',
            'category_id' => 'nullable',
        ]);

        $save = new Stock;
        $save->item = $request->name;
        $save->quantity = $request->quantity;
        $save->withdrawn_datetime = $request->withdrawn;
        $save->returned_datetime = $request->returned;
        $save->category_id = $request->category_id;
        $save->save();
        return redirect('stock')->with('status', 'Item adicionado com sucesso.');

    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'withdrawn' => 'nullable|date',
            'returned' => 'nullable|date',
            'category_id' => 'nullable',
        ]);

        $save = Stock::find($request->stock_id);
        $save->item = $request->name;
        $save->quantity = $request->quantity;
        $save->withdrawn_datetime = $request->withdrawn;
        $save->returned_datetime = $request->returned;
        $save->category_id = $request->category_id;
        $save->save();
        return redirect('stock')->with('status', 'Item atualizado com sucesso.');

    }
}
