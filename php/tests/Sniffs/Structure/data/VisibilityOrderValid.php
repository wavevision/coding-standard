<?php

class VisibilityOrderValid
{

	public const C1 = 1;

	protected const C2 = 1;

	private const C3 = 1;

	public static $s1;

	protected static $s2;

	private static $s3;

	public $m1;

	protected $m2;

	private $m3;

	public function f1()
	{
		return 1;
	}

	protected function f2()
	{
		return 2;
	}

	private function f3()
	{
		return 1;
	}

}

$x = 0;
