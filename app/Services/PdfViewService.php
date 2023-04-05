<?php

namespace App\Services;

use App\Project;
use PDF;

class PdfViewService
{
    public function getPDF(array $projects)
    {    	
		$projects = Project::whereIn('id', array_keys($projects))->with('task')->get();
    	return PDF::loadView('pdf', compact('projects'));
    }
}
