<?php namespace Piphome\Lib;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Envconfig
 * 
 * @author Thomas Smit
 * @since 24/05/16 19:30
 * @package Piphome\Lib
 */
class Envconfig
{

	static public function loadConfig($filename)
	{
		$filename = base_path() . '/env/' . $filename . '.yaml';
		if(!file_exists($filename))
			throw new \Exception('Cannot find env. config file ' . $filename);

		try
		{
			return Yaml::parse(file_get_contents($filename));

		} catch(ParseException $ex) {
			throw new \Exception('Cannot read env. config file ' . $filename);
		}

	}

}