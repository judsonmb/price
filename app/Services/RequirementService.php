<?php

namespace App\Services;

use App\Requirement;

class RequirementService
{
    public function __construct()
    {
        $this->model = new Requirement();
    }

    public function getUserRequirements(int $userId)
    {
        return $this->model->whereHas('project', function($query) use ($userId){
			$query->where('user_id', $userId);
		})->get();
    }

    public function getUserRequirementsPagination(int $userId)
    {
        return $this->model->whereHas('project', function($query) use ($userId){
			$query->where('user_id', $userId);
		})->orderby('project_id')->orderby('created_at')->paginate(10);
    }

    public function storeRequirement(array $data) 
    {
        $this->model->name = $data['name'];
        $this->model->description = $data['description'];
        $this->model->project_id = $data['project_id'];
        return $this->model->save();
    }

    public function getRequirementById(int $id, int $userId) 
    {
        return $this->model->where('id', $id)->with('project', function($query) use ($userId){
            $query->where('user_id', $userId);
        })->first();
    }

    public function updateRequirement(array $data, $id) 
    {
        $requirement = $this->model->find($id);
        $requirement->name = $data['name'];
        $requirement->description = $data['description'];
        $requirement->project_id = $data['project_id'];
        return $requirement->save();
    }

    public function updateFunctionPoint(array $data, $id) 
    {
        $requirement = $this->model->find($id);

        $requirement->fp_total_amount = 0;

        $requirement->ali_data_type_amount = $data['ali_data_type_amount'];
        $requirement->ali_register_type_amount = $data['ali_register_type_amount'];
        $requirement->ali_justify = $data['ali_justify'];

        $requirement->fp_total_amount += $this->calculateAliFpAmount($requirement->ali_data_type_amount, $requirement->ali_register_type_amount);

        $requirement->aie_data_type_amount = $data['aie_data_type_amount'];
        $requirement->aie_register_type_amount = $data['aie_register_type_amount'];
        $requirement->aie_justify = $data['aie_justify'];

        $requirement->fp_total_amount += $this->calculateAieFpAmount($requirement->aie_data_type_amount, $requirement->aie_register_type_amount);

        $requirement->ee_data_type_amount = $data['ee_data_type_amount'];
        $requirement->ee_referenced_files_amount = $data['ee_referenced_files_amount'];
        $requirement->ee_justify = $data['ee_justify'];

        $requirement->fp_total_amount += $this->calculateEeFpAmount($requirement->ee_data_type_amount, $requirement->ee_referenced_files_amount);

        $requirement->se_data_type_amount = $data['se_data_type_amount'];
        $requirement->se_referenced_files_amount = $data['se_referenced_files_amount'];
        $requirement->se_justify = $data['se_justify'];

        $requirement->fp_total_amount += $this->calculateSeFpAmount($requirement->se_data_type_amount, $requirement->se_referenced_files_amount);
       
        $requirement->ce_data_type_amount = $data['ce_data_type_amount'];
        $requirement->ce_referenced_files_amount = $data['ce_referenced_files_amount'];
        $requirement->ce_justify = $data['ce_justify'];

        $requirement->fp_total_amount += $this->calculateCeFpAmount($requirement->ce_data_type_amount, $requirement->ce_referenced_files_amount);

        return $requirement->save();
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

    public function destroyRequirement($id)
    {
        return $this->model->destroy($id);
    }
}
