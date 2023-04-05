<?php

namespace App\Services;

use App\Task;

class TaskService
{
    public function __construct()
    {
        $this->model = new Task();
    }

    public function getUserTasks(int $userId)
    {
        return $this->model->whereHas('project', function($query) use ($userId){
			$query->where('user_id', $userId);
		})->get();
    }

    public function getUserTasksPagination(int $userId)
    {
        return $this->model->whereHas('project', function($query) use ($userId){
			$query->where('user_id', $userId);
		})->orderby('project_id')->orderby('created_at')->paginate(10);
    }

    public function storeTask(array $data) 
    {
        $this->model->name = $data['name'];
        $this->model->description = $data['description'];
        $this->model->type = $data['type'];
        $this->model->project_id = $data['project_id'];
        return $this->model->save();
    }

    public function getTaskById(int $id, int $userId) 
    {
        return $this->model->where('id', $id)->with('project', function($query) use ($userId){
            $query->where('user_id', $userId);
        })->first();
    }

    public function updateTask(array $data, $id) 
    {
        $task = $this->model->find($id);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->type = $data['type'];
        $task->project_id = $data['project_id'];
        return $task->save();
    }

    public function updateFunctionPoint(array $data, $id) 
    {
        $task = $this->model->find($id);

        $task->fp_total_amount = 0;

        $task->ali_data_type_amount = $data['ali_data_type_amount'];
        $task->ali_register_type_amount = $data['ali_register_type_amount'];
        $task->ali_justify = $data['ali_justify'];

        $task->fp_total_amount += $this->calculateAliFpAmount($task->ali_data_type_amount, $task->ali_register_type_amount);

        $task->aie_data_type_amount = $data['aie_data_type_amount'];
        $task->aie_register_type_amount = $data['aie_register_type_amount'];
        $task->aie_justify = $data['aie_justify'];

        $task->fp_total_amount += $this->calculateAieFpAmount($task->aie_data_type_amount, $task->aie_register_type_amount);

        $task->ee_data_type_amount = $data['ee_data_type_amount'];
        $task->ee_referenced_files_amount = $data['ee_referenced_files_amount'];
        $task->ee_justify = $data['ee_justify'];

        $task->fp_total_amount += $this->calculateEeFpAmount($task->ee_data_type_amount, $task->ee_referenced_files_amount);

        $task->se_data_type_amount = $data['se_data_type_amount'];
        $task->se_referenced_files_amount = $data['se_referenced_files_amount'];
        $task->se_justify = $data['se_justify'];

        $task->fp_total_amount += $this->calculateSeFpAmount($task->se_data_type_amount, $task->se_referenced_files_amount);
       
        $task->ce_data_type_amount = $data['ce_data_type_amount'];
        $task->ce_referenced_files_amount = $data['ce_referenced_files_amount'];
        $task->ce_justify = $data['ce_justify'];

        $task->fp_total_amount += $this->calculateCeFpAmount($task->ce_data_type_amount, $task->ce_referenced_files_amount);

        return $task->save();
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

    public function destroyTask($id)
    {
        return $this->model->destroy($id);
    }
}
