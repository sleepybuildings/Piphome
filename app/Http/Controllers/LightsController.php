<?php namespace Piphome\Http\Controllers;

use Illuminate\Http\Request;
use Piphome\Lib\Colors;
use Piphome\Lib\Lights;

class LightsController extends Controller
{

	/**
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getLights()
	{
		$brigde = new Lights;
		$list = [];

		foreach($brigde->getLights() as $light)
			$list[] = $brigde->filterLight($light);

		return response()->json($list);
	}


	public function postToggle(Request $request)
	{
		return response()->json(
			(new Lights())->toggleLight((int)$request->get('lightID'))
		);
	}



}