<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $currentManager = Auth::user()->name; // Отримати ім'я поточного користувача

    if ($currentManager == 'Alex Bertych') {
        // Якщо поточний користувач - Alex Bertych, то показати всіх клієнтів
        $products = Product::orderBy('created_at', 'desc')->get();
    } else {
        // Інакше показати тільки тих клієнтів, яких веде поточний менеджер
        $products = Product::where('manager', $currentManager)
                           ->orderBy('created_at', 'desc')
                           ->get();
    }

    return view('products.index', compact('products', 'currentManager'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
{
    Product::create($request->all());

    return redirect()->route('products')->with('success', 'Добавив, харош!');
}

public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    $product->update($request->all());

    return redirect()->route('products')->with('success', 'Оновив!');
}

public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect()->route('products')->with('success', 'Видалив, ну і ок)');
}
}
