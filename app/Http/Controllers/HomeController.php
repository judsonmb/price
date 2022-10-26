<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\RequirementService;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $projects = (new ProjectService)->getUserProjects(Auth::user()->id);
        $requirements = (new RequirementService)->getUserRequirements(Auth::user()->id);
		return view('home', compact('projects', 'requirements'));
    }
}
