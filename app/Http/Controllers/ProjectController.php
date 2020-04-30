<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('requirement')->where('user_id', Auth::user()->id)->orderby('created_at')->paginate(20);
        return view('projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, null);
        $project = new Project();
        $project->name = $request->name;
        $project->type = $request->type;
        $project->user_id = Auth::user()->id;
        $project->save();
        return redirect()->route('projects.index')->with('status', 'Projeto criado com sucesso!');
    }

    public function makeDocument()
    {
        $projects = Project::with('requirement')->orderby('created_at')->get();
        return view('projects-makedocument', compact('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects-edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $id);
        $project = Project::find($id);
        $project->name = $request->name;
        $project->type = $request->type;
        $project->save();
        return redirect()->route('projects.index')->with('status', 'Projeto editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('projects.index')->with('status', 'Projeto excluído com sucesso!');
    }

    public function validate(Request $request, $id = null, $rules = null, $messages = null, $customAttributes = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:projects,name,'.$id,
            'type' => 'required',
        ]);
    }
}
