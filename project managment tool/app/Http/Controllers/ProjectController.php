<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
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

            $project = new project();
            $project->name = $request->input('name');
            $project->description = $request->input('description');
            $project->status = 'pending';
            $project->deadline = $request->input('deadline');
            if ($request->hasFile('file')){
                $file = $request->file('file');
                $filename = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('project_files'),$filename) ;
                $project->file = $filename;
            }
            $project->user_id= Auth::user()->id;
            $project->save();

            return redirect()->back()->with('success',"project created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        $request->validate([
            'name' => 'required||string',
            'description' => 'required||string',
            'deadline' => 'date||after:now',
            'status' => 'required||in:processing,cancelled,completed,pending||string'
        ]);

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->deadline = $request->input('deadline');
        $project->status = $request->input('status');
        if ($request->hasFile('file')){
            $oldFile= $project->file;
            unlink(public_path('project_files/'.$oldFile));
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalName();
            $file->move(public_path('project_files'),$filename) ;
            $project->file = $filename;
            }
            $project->save();
            return redirect()->back()->with('success',"project updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        if($project->file){
            unlink(public_path('project_files/'.$project->file));
        }
        $project->delete();
        return redirect()->back()->with('success',"project deleted successfully");

    }

    public function update_status( Request $request, project $project){
        $request->validate([
            'status' => 'required||in:processing,cancelled,completed,pending||string'
        ]);
        $project->status = $request->input('status');
        $project->save();
        return redirect()->back()->with('success',"project status updated successfully");
    }

    public function download_file(project $project){
        $file = public_path('project_files/'.$project->file);
        return response()->download($file);
    }
}
