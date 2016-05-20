<?php namespace Piphome\Lib;

/**
 * Class Colors
 *
 * Zie ook http://stackoverflow.com/questions/22564187/rgb-to-philips-hue-hsb
 * http://www.developers.meethue.com/documentation/color-conversions-rgb-xy
 *
 *
 * @author Thomas Smit
 * @since 20/05/16 19:38
 * @package Piphome\Lib
 */
class Colors
{

	static public function implodeRGB($red, $green, $blue)
	{
		return '#' .
			str_pad(dechex($red),   2, '0', STR_PAD_LEFT) .
			str_pad(dechex($green), 2, '0', STR_PAD_LEFT) .
			str_pad(dechex($blue),  2, '0', STR_PAD_LEFT);
	}


	static public function explodeRGB($rgb)
	{
		$rgb = ltrim($rgb, '#');

		if(strlen($rgb) === 3)
			$result = [
				'r' => $rgb[0],
				'g' => $rgb[1],
				'b' => $rgb[2],
			];

		else
			$result = [
				'r' => substr($rgb, 0, 2),
				'g' => substr($rgb, 2, 2),
				'b' => substr($rgb, 4, 2),
			];

		array_walk($result, function(&$val)
		{
			$val = hexdec($val) / 100;
		});

		return $result;
	}

	
	static public function gammaCorrection($color)
	{
		if($color > 0.04045)
			return pow(($color + 0.055) / (1.0 + 0.055), 2.4);

		return $color / 12.92;
	}
	

	static public function rgbToXY($rgb)
	{
		$rgb   = self::explodeRGB($rgb);
		
		$red   = self::gammaCorrection($rgb['r']);
		$green = self::gammaCorrection($rgb['g']);
		$blue  = self::gammaCorrection($rgb['b']);

		$x = ($red * 0.649926  + $green * 0.103455 + $blue * 0.197109);
		$y = ($red * 0.234327  + $green * 0.743075 + $blue * 0.022598);
		$z = ($red * 0.0000000 + $green * 0.053077 + $blue * 1.035763);

		return [
			'x' => $x / ($x + $y + $z),
			'y' => $y / ($x + $y + $z)
		];
	}


	static public function xyToRGB($x, $y, $brightness = 255)
	{
		$brightness = 1;///= 255;

		$z = $brightness - $x - $y;

		$x = ($brightness / $y) * $x;
		$z = ($brightness / $y) * $z;
		$y = $brightness;
		

		//$red   = $x * 1.4628067 - $y * 0.1840623 - $z * 0.2743606;
		//$green = -$x * 0.5217933 + $y * 1.4472381 + $z * 0.0677227;
		//$blue  =  $x * 0.0349342 - $y * 0.0968930 + $z * 1.2884099;

		$red   =  $x * 1.656492 - $y * 0.354851 - $z * 0.255038;
		$green = -$x * 0.707196 + $y * 1.655397 + $z * 0.036152;
		$blue  =  $x * 0.051713 - $y * 0.121364 + $z * 1.011530;

		//self::normalizeRGB($red, $green, $blue);

		$red   = self::reverseGammaCorrection($red);
		$green = self::reverseGammaCorrection($green);
		$blue  = self::reverseGammaCorrection($blue);

		self::normalizeRGB($red, $green, $blue);

		$red   = round(100 * (255/100) * $red);
		$green = round(100 * (255/100) * $green);
		$blue  = round(100 * (255/100) * $blue);

		return self::implodeRGB($red, $green, $blue);
	}


	static public function normalizeRGB(&$red, &$green, &$blue)
	{
		if($red > 1 && $red > $blue && $red > $green)
		{
			$red    = 1;
			$green /= $red;
			$blue  /= $red;

		} else if($green > 1 && $green > $blue && $green > $red)
		{
			$red   /= $green;
			$green  = 1;
			$blue  /= $green;

		} else if($blue > 1 && $blue > $green && $blue > $red)
		{
			$red   /= $blue;
			$green /= $blue;
			$blue   = 1;
		}

		if($red < 0)   $red = 0;
		if($green < 0) $green = 0;
		if($blue < 0)  $blue = 0;
	}


	static public function reverseGammaCorrection($color)
	{
		return $color <= 0.0031308?
			12.92 * $color :
			(1.0 + 0.055) * pow($color, (1.0 / 2.4)) - 0.055;
	}
}