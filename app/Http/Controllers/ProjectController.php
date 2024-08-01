<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $query = Project::query();
        return view('projects.index', compact('projects'));
    }

    // forms pour la creation d'un projet
    public function create(){
        $projects = Project::all();
        return view('projects.create',[
            'projects'=>$projects
        ]);
    }
    
    // Stockage 
    public function store(Request $request)
{
     // dd($request->all());
    $rules = [
        'name' => 'required|string|max:255',
        'description'=>'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        
    ];
    $validatedData = $request->validate($rules);
    $project = new Project();
    $project->name =$request->input('name');
    $project->description =$request->input('description');
    $project->start_date =$request->input('start_date');
    $project->end_date =$request->input('end_date');
    $project->save();
    return redirect()->route('projects.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showTasks(Project $project)
    {
        $tasks = $project->tasks;
        return view('projects.tasks', compact('project', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $project =  Project::findOrFail($id);
        $projects = Project::all();
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    // 80
    public function update(Request $request, string $id)
    {
        //
        // dd($request->all());
        $project = Project::findOrFail($id);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->update();
        return redirect()->route('projects.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index');
    }

}
