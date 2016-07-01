<?php namespace Piphome\Lib;
/**
 * Class Meter
 *
 * @author Thomas Smit
 * @since 01/07/16 21:46
 * @package Piphome\Lib
 */
class Meter
{


	public function getCurrent()
	{
		$current = \DB::table('meter_readings')
			->select('l1')
			->orderBy('send_at', 'desc')
			->first();

		return !$current? 0.00 : floatval($current->l1);
	}
}