<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->service = new ProjectService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->service->getUserProjectsList(Auth::user()->id);
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
    public function store(StoreProjectRequest $request)
    {
        try {
            $this->service->storeProject($request->all());
            return redirect()->route('projects.index')->with('status', 'Projeto criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('projects.create')->with('status', 'Ocorreu um erro interno do servidor');
        }
    }

    public function makeDocument()
    {
        $projects = $this->service->getUserProjects(Auth::user()->id);
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
        try {
            $project = $this->service->getProjectById($id);
            return view('projects-edit', compact('project'));
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        try {
            $this->service->updateProject($request->all(), $id);
            return redirect()->route('projects.index')->with('status', 'Projeto editado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', 'Ocorreu um erro interno do servidor');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->destroyProject($id);
            return redirect()->route('projects.index')->with('status', 'Projeto excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', 'Ocorreu um erro interno do servidor');
        }
    }
}
