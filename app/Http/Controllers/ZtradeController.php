<?php namespace App\Http\Controllers;

use App\Import;

class ZtradeController extends Controller {
	
	public function import()
	{
		return Import::data();
	}

}
