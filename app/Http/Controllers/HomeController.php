<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\TaskService;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $projects = (new ProjectService)->getUserProjects(Auth::user()->id);
        $tasks = (new TaskService)->getUserTasks(Auth::user()->id);
		return view('home', compact('projects', 'tasks'));
    }
}
