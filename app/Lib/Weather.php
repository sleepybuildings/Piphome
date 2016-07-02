<?php namespace Piphome\Lib;

/**
 * Class Weather
 *
 * @author Thomas Smit
 * @since 29/05/16 13:46
 * @package Piphome\Lib
 */
class Weather
{
	const LIVE_URL = 'http://xml.buienradar.nl/';
	const DEBUG_URL = '../weather.xml';

	private $cache = true;
	
	private $localWeatherStationID;

	private $gotWeather = false;

	private $temperature    = 0.00;
	private $sunriseTime    = '';
	private $sunsetTime     = '';
	private $currentWeather = '';
	private $weatherIcon    = '';


	public function __construct()
	{
		$this->localWeatherStationID = (int)env('WEATHER_STATION_ID');
	}


	public function enableCache($enable = true)
	{
		$this->cache = $enable;
		return $this;
	}


	protected function getUrl()
	{
		return env('APP_DEBUG')? self::DEBUG_URL : self::LIVE_URL;
	}


	private function gatherWeatherInfo()
	{
		if(!$this->gotWeather)
		{
			$this->readXML($this->downloadXML());
			$this->gotWeather = true;
		}

		return $this;
	}


	private function readXML($xmlContents)
	{
		$xml = simplexml_load_string($xmlContents);

		$this->sunriseTime = strtotime(current($xml->xpath('weergegevens/actueel_weer/buienradar/zonopkomst')));
		$this->sunsetTime  = strtotime(current($xml->xpath('weergegevens/actueel_weer/buienradar/zononder')));

		$this->weatherIcon = (string)current($xml->xpath('weergegevens/actueel_weer/buienradar/icoonactueel'));
		$this->currentWeather = trim(current($xml->xpath('weergegevens/verwachting_meerdaags/tekst_middellang')));

		if($this->localWeatherStationID)
		{
			$weatherStation = current($xml->xpath('weergegevens/actueel_weer/weerstations/weerstation[@id=' .
				$this->localWeatherStationID . ']'
			));

			if(!empty($weatherStation))
			{
				$this->weatherIcon = $this->findIcon((string)$weatherStation->icoonactueel->attributes()->zin);
				$this->temperature = floatval($weatherStation->temperatuurGC);
			}
		}
	}


	protected function findIcon($zin)
	{
		$icons = [
			'zonnig'                          => 'wi-day-sunny',
			'bewolkt'                         => 'wi-cloudy',
			'zonnig en bewolkt'               => 'wi-day-cloudy',
			'bewolkt en regen'                => 'wi-day-rain',
			'zonnig met lichte regen'         => 'wi-hail',
			'zonnig, bewolkt en lichte regen' => 'wi-day-hail',
		];

		return isset($icons[$zin])? $icons[$zin] : 'wi-meteor';
	}


	protected function downloadXML()
	{
		return file_get_contents($this->getUrl());
	}
	

	public function getSunriseTime()
	{
		return $this->gatherWeatherInfo()->sunriseTime;
	}


	public function getCurrentWeather()
	{
		return $this->gatherWeatherInfo()->currentWeather;
	}


	public function getSunsetTime()
	{
		return $this->gatherWeatherInfo()->sunsetTime;
	}


	public function getWeatherIcon()
	{
		return $this->gatherWeatherInfo()->weatherIcon;
	}


	public function getTemperature()
	{
		return $this->gatherWeatherInfo()->temperature;
	}




}