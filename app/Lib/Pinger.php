<?php namespace Piphome\Lib;

/**
 * Class Pinger
 *
 * @author Thomas Smit
 * @since 24/05/16 19:30
 * @package Piphome\Lib
 */
class Pinger
{

	protected $devices = [];


	public function __construct()
	{
		$this->devices = Envconfig::loadConfig('networkdevices');
	}


	public function checkDevices()
	{
		$result = [];

		foreach($this->devices as $name => $ip)
		{
			$result[] = [
				'name'   => $name,
				'ip'     => $ip,
				'online' => $this->isOnline($ip)
			];
		}

		return $result;
	}


	protected function isOnline($ipAddress)
	{
		$result = [];

		// uhuh
		if(preg_match('/(\d+)% packet loss/i', shell_exec((env('DEBUG')? '' : 'sudo ') . 'ping -w1 -c1 ' . $ipAddress), $result))
		{
			return isset($result[1]) && floatval($result[1]) < 100;
		}

		return false;
	}

}