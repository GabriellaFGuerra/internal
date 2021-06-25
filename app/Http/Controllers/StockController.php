<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index()
    {
        $items = Stock::with('category')->paginate(10);
        return view('stock.index')->with('items', $items);
    }

    public function create()
    {
        $categories = Category::all();
        return view('stock.add')->with('categories', $categories);
    }

    public function store(Request $request)
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

    public function edit($id)
    {
        $categories = $this->showCategories();
        $item = Stock::find($id);
        return view('stock.edit', ['categories' => $categories, 'item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'withdrawn' => 'nullable|date',
            'returned' => 'nullable|date',
            'category_id' => 'nullable',
        ]);

        $save = Stock::find($id);
        $save->item = $request->name;
        $save->quantity = $request->quantity;
        $save->withdrawn_datetime = $request->withdrawn;
        $save->returned_datetime = $request->returned;
        $save->category_id = $request->category_id;
        $save->save();
        return redirect('stock')->with('status', 'Item atualizado com sucesso.');
    }

    public function delete($id)
    {
        $delete = Stock::find($id);
        try {
            $delete->delete();
            return redirect('stock')->with('status', 'Item deletado com sucesso.');
        } catch (\Exception $e) {
            return redirect('stock')->with('error', $e->getMessage());
        }
    }
}
