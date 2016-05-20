<?php namespace Piphome\Lib;

declare(strict_types=1);

use Illuminate\Support\Facades\Cache;
use Phue\Light;
use Mexitek\PHPColors\Color;


class Lights
{

	/**
	 * @var \Phue\Client
	 */
	protected $client;


	public function __construct()
	{
		$this->client = new \Phue\Client(env('LIGHTS_HOST'), env('LIGHTS_KEY'));
	}


	/**
	 * @return \Phue\Light[]
	 */
	public function getLights()
	{
		return $this->client->getLights();
	}


	/**
	 * Toggle een lamp aan of uit
	 *
	 * @param $lightID
	 * @return \Phue\Light
	 * @throws \Exception
	 */
	public function toggleLight($lightID)
	{
		$lights = $this->getLights();

		if(!isset($lights[$lightID]))
			throw new \Exception('Light not found: ' . $lightID);

		$lights[$lightID]->setOn(!$lights[$lightID]->isOn());

		return $this->filterLight($lights[$lightID]);
	}


	/**
	 * Filter lightobj
	 *
	 * @param Light $light
	 * @return array
	 */
	public function filterLight(Light $light)
	{
		$xy = $light->getXY();

		return [
			'on'         => $light->isOn(),
			'id'         => $light->getId(),
			'name'       => $light->getName(),
			'reachable'  => $light->isReachable(),
			'brightness' => $light->getBrightness(),
			'hue'        => $light->getHue(),
			'saturation' => $light->getSaturation(),
			'colorTemp'  => $light->getColorTemp(),
			'hexColor'   => Colors::xyToRGB($xy['x'], $xy['y'], $light->getBrightness()),
 		];
	}


	protected function convertColorToHex(Light $light)
	{
		// Bri 0..255
		// Heu 0..65535
		// Sat 0..25
		return '#' . Color::hslToHex([
			'H' => $light->getHue(),
			'S' => ((100/ 256) * $light->getSaturation()) / 100,
			'L' => ((100/ 256) * $light->getBrightness()) / 100,
		]);
	}


}