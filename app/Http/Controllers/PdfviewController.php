<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use PDF;

class PdfviewController extends Controller
{
    
    public function index(Request $request)
    {

    	$projects = Project::with('requirement')->get();

    	foreach($projects as $p)
    	{
			$name = 'p'.$p->id;
    		if(!isset($request->$name))
    		{
				$id = $p->id - 1;
    			$projects->forget($id);
    		}
		}

    	set_time_limit(300);	

    	$pdf = PDF::loadView('pdf', compact('projects'));
		return $pdf->stream('document.pdf');
    }

}
