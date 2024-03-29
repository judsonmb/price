<?php

namespace App\Services;

use App\Project;
use Auth;

class ProjectService
{
    public function __construct()
    {
        $this->model = new Project();
    }

    public function getUserProjects(int $userId)
    {
        return $this->model->where('user_id', $userId)->orderby('created_at')->get();
    }

    public function getUserProjectsList(int $userId)
    {
        return $this->model->with('task')->where('user_id', $userId)->orderby('created_at')->paginate(20);
    }

    public function storeProject(array $data)
    {
        $this->model->name = $data['name'];
        $this->model->user_id = Auth::user()->id;
        return $this->model->save();
    }

    public function getProjectById(int $id) 
    {
        return $this->model->where('id', $id)->where('user_id', Auth::user()->id)->first();
    }

    public function updateProject(array $data, $id)
    {
        $project = $this->model->find($id);
        $project->name = $data['name'];
        return $project->save();
    }

    public function destroyProject($id)
    {
        return $this->model->destroy($id);
    }
}
