<?php namespace Piphome\Http\Controllers;

use Piphome\Lib\Pinger;

/**
 * Class Pinger
 *
 * @author Thomas Smit
 * @since 24/05/16 19:44
 * @package Piphome\Http\Controllers
 */
class PingerController extends Controller
{

	/**
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getPing()
	{
		return response()->json((new Pinger())->checkDevices());
	}
}