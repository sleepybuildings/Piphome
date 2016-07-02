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

}