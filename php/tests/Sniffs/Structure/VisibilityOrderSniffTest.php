<?php declare(strict_types = 1);

namespace WavevisionCodingStandard\Sniffs\Structure;

use SlevomatCodingStandard\Sniffs\TestCase;

class VisibilityOrderSniffTest extends TestCase
{


	public function testError(): void
	{
		$checkedFile = self::checkFile(__DIR__ . '/data/VisibilityOrderInvalid.php');
		self::assertSniffError(
			$checkedFile,
			8,
			VisibilityOrderSniff::INVALID_CONSTANT_ORDER
		);
		self::assertSniffError(
			$checkedFile,
			14,
			VisibilityOrderSniff::INVALID_STATIC_PROPERTIES_ORDER
		);
		self::assertSniffError(
			$checkedFile,
			20,
			VisibilityOrderSniff::INVALID_MEMBER_ORDER
		);
	}

	public function testValid(): void
	{
		self::assertNoSniffError(self::checkFile(__DIR__ . '/data/VisibilityOrderValid.php'), 6);
	}
}
