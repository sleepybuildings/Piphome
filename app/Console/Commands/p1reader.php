<?php namespace Piphome\Console\Commands;

use Illuminate\Console\Command;
use Piphome\Lib\Meter;

class p1reader extends Command
{
	protected $signature = 'p1';

	protected $description = 'p1 reader';

	public function __construct()
	{
		parent::__construct();
	}


	public function handle()
	{
		$input = fgets(STDIN);

		if(!empty($input))
			(new Meter())->saveMeterInfo($input);
	}
}
