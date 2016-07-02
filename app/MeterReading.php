<?php namespace Piphome;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MeterReading
 *
 * @property int version
 * @property str send_at
 * @property float meter_in_normal
 * @property float meter_in_low
 * @property float power_in
 * @property float l1
 * @author Thomas Smit
 * @since 02/07/16 10:51
 * @package Piphome
 */
class MeterReading extends Model
{

	public $table = 'meter_readings';

	public $timestamps = false;


	public function getCurrent()
	{
		$current = \DB::table($this->table)
			->select('l1')
			->orderBy('send_at', 'desc')
			->first();

		return !$current? 0.00 : floatval($current->l1);
	}


	public function getDay($day)
	{
		$day = date('Y-m-d ', is_int($day)? $day : strtotime($day));

		$rows = \DB::table($this->table)
			->select(
				//\DB::raw('TIME(send_at) AS time'),
				'send_at',
				'l1'
			)->whereBetween('send_at', [$day . '00:00', $day . '23:59'])
			->orderBy('send_at')
			->get();

		// Omzetten naar een platte array zodat de json conversie er geen objecten
		// van maakt...

		$result = [];
		foreach($rows as $row)
			$result[] = [
				date('c', strtotime($row->send_at)),
				floatval($row->l1)
			];

		return $result;
	}


}