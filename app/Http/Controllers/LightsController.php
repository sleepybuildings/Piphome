<?php namespace Piphome\Http\Controllers;

use Piphome\Lib\Lights;

class LightsController extends Controller
{

	/**
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getLights()
	{
		$lights = (new Lights())->getLights();
		$list = [];

		foreach($lights as $light)
		{
			$list[] = [
				'name' => $light->getName(),
				'brightness' => $light->getBrightness(),
				'on' => $light->isOn(),
				'reachable' => $light->isReachable(),
			];
		}

		return response()->json($list);
	}



}