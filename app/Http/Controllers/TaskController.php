<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Project; // Import de la classe Project

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->query('status');
        $project_id = $request->query('project_id');

        $query = Task::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($project_id) {
            $query->where('project_id', $project_id);
        }

        $tasks = $query->get();
        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $tasks = Task::all();
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function bystatus(string $status)
    {
        //dd($status)
        $task = Task::firstWhere('status',$status);
        if(!isset($task))
            return redirect()->route('tasks.index');
        $tasks = $task->tasks;

    }
    
        //stockage
    public function store(Request $request)
    {
    $rules = [
        'project_id' => 'required|exists:projects,id',
        'title' => 'required|string|max:255',
        'description'=>'required|string|max:255',
        'status' => 'required|in:pending,in_progress,completed',
    ];
    // Créer la tâche
    $validatedData = $request->validate($rules);
    $task = new Task();
    $task->project_id = $request->input('project_id');
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->status = $request->input('status');
    $task->save();
    return redirect()->route('tasks.index');

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


    public function edit(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $tasks = Task::all();
        $projects = Project::all();
        $project = Project::findOrFail($id);
        return view('tasks.edit',compact('task','project'));
    }

    public function update(Request $request,string $id)
    {
        // dd($request->all());
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description =$request->input('description');
        $task->status = $request->input('status');
        $task->update();
        return redirect()->route('tasks.index');

    }

    public function destroy(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');

    }

}
