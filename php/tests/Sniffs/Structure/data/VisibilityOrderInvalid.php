<?php

class VisibilityOrderInvalid
{

	protected const C2 = 1;

	public const C1 = 1;

	private const C3 = 1;

	private static $s3;

	public static $s1;

	protected static $s2;

	protected $m2;

	public $m1;

	private $m3;

	public function f1()
	{
		return 1;
	}

	private function f3()
	{
		$fvar = '1';
		return 1;
	}

	protected function f2()
	{
		return 2;
	}

}

$gvar = '';

