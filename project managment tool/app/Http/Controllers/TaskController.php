<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

   public function index()
   {
       $tasks = task::all();
       return view('tasks.index', compact('tasks'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
    $users= User::all()->except(['id'=>Auth::user()->id]);
    $projects = project::all();
       return view('tasks.create',compact('users','projects'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required||string',
           'description' => 'required||string',
           'deadline' => 'required||date||after:now',

           ]);

           $task = new task();
           $task->name = $request->input('name');
           $task->description = $request->input('description');
           $task->status = 'pending';
           $task->project_id = $request->input('project');
           $task->deadline = $request->input('deadline');
           if ($request->hasFile('file')){
               $file = $request->file('file');
               $filename = time().'.'.$file->getClientOriginalName();
               $file->move(public_path('task_files'),$filename) ;
               $task->file = $filename;
           }
           $task->created_by= Auth::user()->id;
           $task->assigned_to = $request->input('assigned_to');
           $task->save();

           return redirect()->back()->with('success',"task created successfully");
   }

   /**
    * Display the specified resource.
    */
   public function show(task $task)
   {

       return view('tasks.show', compact('task'));
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(task $task)
   {
    $authUserId = Auth::user()->id;

    $assignedUserId = $task->assignedTo->id;

    // Fetch all users except the authenticated user and the assigned user
    $users = User::whereNotIn('id', [$authUserId, $assignedUserId])->get();
    $projects = project::all()->except(['id'=>$task->project->id]);
       return view('tasks.edit', compact('task','users','projects'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, task $task)
   {
       $request->validate([
           'name' => 'required||string',
           'description' => 'required||string',
           'deadline' => 'date||after:now',
           'status' => 'required||in:processing,cancelled,completed,pending||string'
       ]);

       $task->name = $request->input('name');
       $task->description = $request->input('description');
       $task->deadline = $request->input('deadline');
       $task->project_id = $request->input('project');
       $task->status = $request->input('status');
       if ($request->hasFile('file')){
           $oldFile= $task->file;
           unlink(public_path('task_files/'.$oldFile));
           $file = $request->file('file');
           $filename = time().'.'.$file->getClientOriginalName();
           $file->move(public_path('task_files'),$filename) ;
           $task->file = $filename;
           }
           $task->assigned_to = $request->input('assigned_to');
           $task->save();
           return redirect()->back()->with('success',"task updated successfully");

   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(task $task)
   {
       if($task->file){
           unlink(public_path('task_files/'.$task->file));
       }
       $task->delete();
       return redirect()->back()->with('success',"task deleted successfully");

   }

   public function update_status( Request $request, task $task){
       $request->validate([
           'status' => 'required||in:processing,cancelled,completed,pending||string'
       ]);
       $task->status = $request->input('status');
       $task->save();
       return redirect()->back()->with('success',"task status updated successfully");
   }

   public function download_file(task $task){
       $file = public_path('task_files/'.$task->file);
       return response()->download($file);
   }
}
