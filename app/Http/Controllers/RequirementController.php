<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Requirement;

use App\Project;

use Auth;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
        $requirements = Requirement::with('project')->whereIn('project_id', function($query){
			$query->select('id')
				  ->from('projects')
				  ->where('user_id', Auth::user()->id);
		})->orderby('project_id')->orderby('created_at')->paginate(10);
		
        return view('requirements', compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $projects = ($id == null) ? Project::orderBy('created_at')->get() : Project::where('id', $id)->get();
        return view('requirements-create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request);
        $requirement = new Requirement();
        $requirement->name = $request->name;
        $requirement->description = $request->description;
        $requirement->project_id = $request->project_id;
        $requirement->save();
        return \Redirect::back()->with('status', 'Requisito criado com sucesso!');
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
        $requirement = Requirement::with('project')->find($id);
        $projects = Project::orderBy('name')->get();
        return view('requirements-edit', compact('requirement', 'projects'));
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
        $requirement = Requirement::find($id);
        $requirement->name = $request->name;
        $requirement->description = $request->description;
        $requirement->project_id = $request->project_id;
        $requirement->save();
        return redirect()->route('requirements.index')->with('status', 'Requisito editado com sucesso!');
    }

    public function editfp($id){
        $requirement = Requirement::find($id);
        return view('requirements-editfp', compact('requirement'));
    }

    public function updatefp(Request $request, $id)
    {
        $requirement = Requirement::find($id);

        $requirement->fp_total_amount = 0;

        $requirement->ali_data_type_amount = $request->ali_data_type_amount;
        $requirement->ali_register_type_amount = $request->ali_register_type_amount;
        $requirement->ali_justify = $request->ali_justify;

        $requirement->fp_total_amount += $this->calculateAliFpAmount($requirement->ali_data_type_amount, $requirement->ali_register_type_amount);

        $requirement->aie_data_type_amount = $request->aie_data_type_amount;
        $requirement->aie_register_type_amount = $request->aie_register_type_amount;
        $requirement->aie_justify = $request->aie_justify;

        $requirement->fp_total_amount += $this->calculateAieFpAmount($requirement->aie_data_type_amount, $requirement->aie_register_type_amount);

        $requirement->ee_data_type_amount = $request->ee_data_type_amount;
        $requirement->ee_referenced_files_amount = $request->ee_referenced_files_amount;
        $requirement->ee_justify = $request->ee_justify;

        $requirement->fp_total_amount += $this->calculateEeFpAmount($requirement->ee_data_type_amount, $requirement->ee_referenced_files_amount);

        $requirement->se_data_type_amount = $request->se_data_type_amount;
        $requirement->se_referenced_files_amount = $request->se_referenced_files_amount;
        $requirement->se_justify = $request->se_justify;

        $requirement->fp_total_amount += $this->calculateSeFpAmount($requirement->se_data_type_amount, $requirement->se_referenced_files_amount);
       
        $requirement->ce_data_type_amount = $request->ce_data_type_amount;
        $requirement->ce_referenced_files_amount = $request->ce_referenced_files_amount;
        $requirement->ce_justify = $request->ce_justify;

        $requirement->fp_total_amount += $this->calculateCeFpAmount($requirement->ce_data_type_amount, $requirement->ce_referenced_files_amount);

        $requirement->save();
        
        return redirect()->route('projects.index')->with('status', 'Pontos de função calculados e atualizados com sucesso!');
    }

    public function calculateAliFpAmount($td, $tr)
    {
        if($td == 0 && $tr == 0)
        {
            return 0;
        }

        if($td < 20 && $tr == 1){
            return 7;
        }

        if($td < 20 && ($tr >= 2 && $tr <= 5)){
            return 7;
        }

        if($td < 20 && $tr > 5){
            return 10;
        }

        ///////

        if(($td >= 20 && $td <= 50) && $tr == 1){
            return 7;
        }

        if(($td >= 20 && $td <= 50) && ($tr >= 2 && $tr <= 5)){
            return 10;
        }

        if(($td >= 20 && $td <= 50) && $tr > 5){
            return 15;
        }

        ///////

        if($td > 50 && $tr == 1){
            return 10;
        }

        if($td > 50 && ($tr >= 2 && $tr <= 5)){
            return 15;
        }

        if($td > 50 && $tr > 5){
            return 15;
        }

        return 0;

    }

    public function calculateAieFpAmount($td, $tr)
    {
        if($td == 0 && $tr == 0)
        {
            return 0;
        }

        if($td < 20 && $tr == 1){
            return 5;
        }

        if($td < 20 && ($tr >= 2 && $tr <= 5)){
            return 5;
        }

        if($td < 20 && $tr > 5){
            return 7;
        }

        ///////

        if(($td >= 20 && $td <= 50) && $tr == 1){
            return 5;
        }

        if(($td >= 20 && $td <= 50) && ($tr >= 2 && $tr <= 5)){
            return 7;
        }

        if(($td >= 20 && $td <= 50) && $tr > 5){
            return 10;
        }

        ///////

        if($td > 50 && $tr == 1){
            return 7;
        }

        if($td > 50 && ($tr >= 2 && $tr <= 5)){
            return 10;
        }

        if($td > 50 && $tr > 5){
            return 10;
        }

        return 0;

    }

    public function calculateEeFpAmount($td, $tr)
    {
        if($td == 0 && $tr == 0)
        {
            return 0;
        }

        if($td < 5 && $tr < 2){
            return 3;
        }

        if($td < 5 && $tr == 2){
            return 3;
        }

        if($td < 5 && $tr > 2){
            return 4;
        }

        ///////

        if(($td >= 5 && $td <= 15) && $tr < 2){
            return 3;
        }

        if(($td >= 5 && $td <= 15) && $tr == 2){
            return 4;
        }

         if(($td >= 5 && $td <= 15) && $tr > 2){
            return 6;
        }

        ///////

        if($td > 15 && $tr < 2){
            return 4;
        }

        if($td > 15 && $tr == 2){
            return 6;
        }

        if($td > 15 && $tr > 2){
            return 6;
        }

        return 0;
    }

    public function calculateSeFpAmount($td, $tr)
    {
        if($td == 0 && $tr == 0)
        {
            return 0;
        }

        if($td < 6 && $tr < 2){
            return 4;
        }

        if(($td < 6) && ($tr == 2 || $tr == 3)){
            return 4;
        }

        if($td < 6 && $tr > 3){
            return 5;
        }

        ///////

        if(($td >= 6 && $td <= 15) && ($tr < 2)){
            return 4;
        }

        if(($td >= 6 && $td <= 15) && ($tr == 2 || $tr == 3)){
            return 5;
        }

         if(($td >= 6 && $td <= 15) && ($tr > 3)){
            return 7;
        }

        ///////

        if($td > 15 && $tr < 2){
            return 5;
        }

        if(($td > 15) && ($tr == 2 || $tr == 3)){
            return 7;
        }

        if($td > 15 && $tr > 3){
            return 7;
        }

        return 0;
    }

    public function calculateCeFpAmount($td, $tr)
    {
       if($td == 0 && $tr == 0)
        {
            return 0;
        }

       if($td < 6 && $tr < 2)
        {
            return 3;
        }

        if(($td < 6) && ($tr == 2 || $tr == 3))
        {
            return 3;
        }

        if($td < 6 && $tr > 3)
        {
            return 4;
        }

        ///////

        if(($td >= 6 && $td <= 15) && $tr < 2)
        {
            return 3;
        }

        if(($td >= 6 && $td <= 15) && ($tr == 2 || $tr == 3))
        {  
            return 4;
        }

        if(($td >= 6 && $td <= 15) && $tr > 3){
            return 6;
        }

        ///////

        if($td > 15 && $tr < 2){
            return 4;
        }

        if($td > 15 && ($tr == 2 || $tr == 3))
        {
            return 6;
        }

        if($td > 15 && $tr > 3)
        {
            return 6;
        }

        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Requirement::destroy($id);
        return redirect()->route('requirements.index')->with('status', 'Requisito excluído com sucesso!');
    }

    public function validate(Request $request, $id = null, $rules = null, $messages = null, $customAttributes = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'description' => 'required',
            'project_id' => 'required',
            'ali_justify' => 'max:255',
            'aie_justify' => 'max:255',
            'ee_justify' => 'max:255',
            'se_justify' => 'max:255',
            'ce_justify' => 'max:255',
        ]);
    }

}
