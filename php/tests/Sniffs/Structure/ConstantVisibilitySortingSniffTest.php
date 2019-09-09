<?php declare(strict_types = 1);

namespace WavevisionCodingStandard\Sniffs\Structure;

use SlevomatCodingStandard\Sniffs\TestCase;

class ConstantVisibilitySortingSniffTest extends TestCase
{

	public function testError(): void
	{
		self::assertSniffError(
			self::checkFile(__DIR__ . '/data/ConstantVisibilitySortingSniffInvalid.php'),
			6,
			ConstantVisibilitySortingSniff::CODE_INCORRECTLY_SORTED_VISIBILITY
		);
	}

	public function testNoError(): void
	{
		self::assertNoSniffError(self::checkFile(__DIR__ . '/data/ConstantVisibilitySortingSniffValid.php'), 6);
	}
}
