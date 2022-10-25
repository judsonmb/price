<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RequirementService;
use App\Services\ProjectService;
use App\Http\Requests\StoreRequirementRequest;
use App\Http\Requests\UpdateRequirementRequest;
use Auth;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->service = new RequirementService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
        $requirements = $this->service->getUserRequirementsPagination(Auth::user()->id);
        return view('requirements', compact('requirements'));
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
        return view('requirements-create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequirementRequest $request)
    {
        try {
            $this->service->storeRequirement($request->all());
            return \Redirect::back()->with('status', 'Requisito criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('requirements.create')->with('status', 'Ocorreu um erro interno do servidor');
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
        $requirement = $this->service->getRequirementById($id, Auth::user()->id);
        $projects = (new ProjectService)->getUserProjects(Auth::user()->id);
        return view('requirements-edit', compact('requirement', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequirementRequest $request, $id)
    {
        try {
            $this->service->updateRequirement($request->all(), $id);
            return redirect()->route('requirements.index')->with('status', 'Requisito editado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('requirements.index')->with('status', 'Ocorreu um erro interno do servidor');
        }     
    }

    public function editFunctionPoint($id){
        $requirement = $this->service->getRequirementById($id, Auth::user()->id);
        return view('requirements-editFunctionPoint', compact('requirement'));
    }

    public function updateFunctionPoint(Request $request, $id)
    {
        try {
            $this->service->updateFunctionPoint($request->all(), $id);
            return redirect()->route('requirements.index')->with('status', 'Pontos de função calculados e atualizados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('requirements.index')->with('status', 'Ocorreu um erro interno do servidor');
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
            $this->service->destroyRequirement($id);
            return redirect()->route('requirements.index')->with('status', 'Requisito excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', 'Ocorreu um erro interno do servidor');
        }
    }
}
