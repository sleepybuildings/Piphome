<?php namespace Piphome\Lib;
use Piphome\MeterReading;

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
		return (new MeterReading())->getCurrent();
	}


	public function getDay($day)
	{
		return (new MeterReading())->getDay($day);
	}


	public function saveMeterInfo($line)
	{
		$line = str_getcsv($line);
		if(count($line) !== 6)
			return false;

		$this->storeMeterInfo($line);

		return true;
	}


	protected function storeMeterInfo(array $line)
	{
		$entry = new MeterReading;

		$entry->version         = $line[0];
		$entry->send_at         = date('Y-m-d H:i:s');
		$entry->meter_in_normal = $line[2];
		$entry->meter_in_low    = $line[3];
		$entry->power_in        = $line[4];
		$entry->l1              = $line[5];

		$entry->save();
	}
}