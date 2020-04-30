<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use App\Requirement;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id);
	
		$requirements = Requirement::with('project')->whereIn('project_id', function($query){
			$query->select('id')
				  ->from('projects')
				  ->where('user_id', Auth::user()->id);
		});
		
		return view('home', compact('projects', 'requirements'));
    }
}
