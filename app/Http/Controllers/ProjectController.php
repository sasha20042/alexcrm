<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Project;
 
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::orderBy('created_at', 'DESC')->get();
  
        return view('project.index', compact('project'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Project::create($request->all());
 
        return redirect()->route('project')->with('success', 'Добавив, харош!');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
  
        return view('project.show', compact('project'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
  
        return view('project.edit', compact('project'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
  
        $project->update($request->all());
  
        return redirect()->route('project')->with('success', 'Оновив!');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
  
        $project->delete();
  
        return redirect()->route('project')->with('success', 'Видалив, ну і ок)');
    }
}