<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $team = User::all(); // Or apply any filtering if necessary
    return view('team.index', compact('team'));
    $currentManager = Auth::user()->name; // Отримати ім'я поточного користувача

    if ($currentManager == 'Alex Bertych' || $currentManager == 'Oleksandr Kopolovets') {
        // Якщо поточний користувач - Alex Bertych, то показати всіх клієнтів
        $team = Team::orderBy('created_at', 'desc')->get();
    } else {
        // Інакше показати тільки тих клієнтів, яких веде поточний менеджер
        $team = Team::where('manager', $currentManager)
                           ->orderBy('created_at', 'desc')
                           ->get();
    }

    return view('team.index', compact('team', 'currentManager'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team= Team::findOrFail($id);

        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team= Team::findOrFail($id);

        return view('team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
{
    Team::create($request->all());

    return redirect()->route('team')->with('success', 'Добавив, харош!');
}

public function update(Request $request, string $id)
{
    $team= Team::findOrFail($id);

    $team->update($request->all());

    return redirect()->route('team')->with('success', 'Оновив!');
}

public function destroy(string $id)
{
    $team= Team::findOrFail($id);

    $team->delete();

    return redirect()->route('team')->with('success', 'Видалив, ну і ок)');
}

}
