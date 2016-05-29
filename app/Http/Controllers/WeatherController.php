<?php namespace Piphome\Http\Controllers;
use Piphome\Lib\Weather;

/**
 * Class WeatherController
 *
 * @author Thomas Smit
 * @since 29/05/16 13:50
 * @package Piphome\Http\Controllers
 */
class WeatherController extends Controller
{

	public function getTest()
	{
		setlocale(LC_NUMERIC, 'nl_NL');
		
		$weather = new Weather();
		$weather->enableCache(false);

		return response()->json([
			'temperature' => sprintf('%.1f', $weather->getTemperature()),
			'icon'        => $weather->getWeatherIcon(),
			'weather'     => $weather->getCurrentWeather(),
			'sunrise'     => date('H:i', $weather->getSunriseTime()),
			'sunset'      => date('H:i', $weather->getSunsetTime()),
		]);
	}
}