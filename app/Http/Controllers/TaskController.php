<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TaskService;
use App\Services\ProjectService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->service = new TaskService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
        $tasks = $this->service->getUserTasksPagination(Auth::user()->id);
        return view('tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if ($id == null) {
            $projects = (new ProjectService)->getUserProjects(Auth::user()->id);
        } else {
            $projects = (new ProjectService)->getProjectById($id);
        }
        return view('tasks-create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $this->service->storeTask($request->all());
            return \Redirect::back()->with('status', 'Tarefa criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.create')->with('status', 'Ocorreu um erro interno do servidor');
        }        
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
        $task = $this->service->getTaskById($id, Auth::user()->id);
        $projects = (new ProjectService)->getUserProjects(Auth::user()->id);
        return view('tasks-edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $this->service->updateTask($request->all(), $id);
            return redirect()->route('tasks.index')->with('status', 'Tarefa editado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('status', 'Ocorreu um erro interno do servidor');
        }     
    }

    public function editFunctionPoint($id){
        $task = $this->service->getTaskById($id, Auth::user()->id);
        return view('tasks-editFunctionPoint', compact('task'));
    }

    public function updateFunctionPoint(Request $request, $id)
    {
        try {
            $this->service->updateFunctionPoint($request->all(), $id);
            return redirect()->route('tasks.index')->with('status', 'Pontos de função calculados e atualizados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('status', 'Ocorreu um erro interno do servidor');
        }
        
        return redirect()->route('projects.index')->with('status', 'Pontos de função calculados e atualizados com sucesso!');
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
            $this->service->destroyTask($id);
            return redirect()->route('tasks.index')->with('status', 'Tarefa excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', 'Ocorreu um erro interno do servidor');
        }
    }
}
