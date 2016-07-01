<?php namespace Piphome\Http\Controllers;

use Illuminate\Http\Request;
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

	
	public function postTurnAllOff()
	{
		return response()->json([
			'off' => (new Lights())->turnAllOff()
		]);
	}

	public function postSetColors(Request $request)
	{
		return response()->json([
			'success' => (new Lights())->setColors(
				$request->get('lights', []),
				$request->get('color', null),
				$request->get('brightness', 255)
			)
		]);
	}


}