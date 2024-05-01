<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Depart;
 
class DepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $depart = Depart::orderBy('created_at', 'DESC')->get();
        return view('depart.index', compact('depart'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depart.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Depart::create($request->all());
 
        return redirect()->route('depart')->with('success', 'Добавив, харош!');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depart = Depart::findOrFail($id);
  
        return view('depart.show', compact('depart'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depart = Depart::findOrFail($id);
  
        return view('depart.edit', compact('depart'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $depart = Depart::findOrFail($id);
  
        $depart->update($request->all());
  
        return redirect()->route('depart')->with('success', 'Оновив!');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depart = Depart::findOrFail($id);
  
        $depart->delete();
  
        return redirect()->route('depart')->with('success', 'Видалив, ну і ок)');
    }
}