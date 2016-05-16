<?php namespace Piphome\Lib;

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


}