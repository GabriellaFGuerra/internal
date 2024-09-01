<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index()
    {
        return view('stock.index', [
            'items' => Stock::with('category')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('stock.add', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $save = new Stock($request->validated());
        $save->save();

        return redirect()->route('stock')->with('status', 'Item adicionado com sucesso.');
    }

    public function edit(Stock $stock)
    {
        return view('stock.edit', [
            'categories' => Category::all(),
            'item' => $stock,
        ]);
    }

    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->validated());

        return redirect()->route('stock')->with('status', 'Item atualizado com sucesso.');
    }

    public function destroy(Stock $stock)
    {
        try {
            $stock->delete();
            return redirect()->route('stock')->with('status', 'Item deletado com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

