<?php namespace Piphome\Lib;

use Phue\Command\SetLightState;
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


	public function setColors($forLights, $color, $brightness = 255)
	{
		$lights = $this->getLights();

		foreach($forLights as $lightID)
			foreach($lights as $light)
			{
				if($light->getId() == $lightID)
				{
					if(!$light->isOn())
						$light->setOn(true);

					if(count($color) == 3)
						$light->setRGB($color['r'], $color['g'], $color['b']);

					$light->setBrightness($brightness);
				}
			}
	}


	/**
	 * @return \Phue\Light[]
	 */
	public function getLights()
	{
		return $this->client->getLights();
	}


	public function turnAllOff()
	{
		$lights = 0;
		foreach($this->getLights() as $light)
		{
			$command = new SetLightState($light);
			$command->on(false);
			$command->send($this->client);
			$lights++;
		}

		return $lights;
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