<?php namespace Piphome\Http\Controllers;
use Piphome\Lib\Meter;

/**
 * Class MeterController
 *
 * @author Thomas Smit
 * @since 01/07/16 21:44
 * @package Piphome\Http\Controllers
 */
class MeterController extends Controller
{

	public function getCurrent()
	{
		return response()->json([
			'current' => (new Meter())->getCurrent(),
		]);
	}


	public function getToday()
	{
		return response()->json([
			'dataset' => (new Meter())->getDay(time()),
		]);
	}

}