<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfViewService;
use App\Services\ProjectService;
use Auth;
use PDF;

class PdfviewController extends Controller
{
	public function __construct()
	{
		$this->service = new PdfViewService();
	}
	
	public function index(Request $request)
    {
		$pdf = $this->service->getPDF($request->all());
		return $pdf->stream('document.pdf');
    }
}
