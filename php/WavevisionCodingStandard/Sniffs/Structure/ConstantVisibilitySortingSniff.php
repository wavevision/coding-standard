<?php declare(strict_types = 1);

namespace WavevisionCodingStandard\Sniffs\Structure;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ConstantVisibilitySortingSniff implements Sniff
{

	public const CODE_INCORRECTLY_SORTED_VISIBILITY = 'IncorrectlySortedVisibility';

	/**
	 * @return array<mixed>
	 */
	public function register(): array
	{
		return [T_CONST];
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 * @return void|int
	 */
	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$ptr = $stackPtr;
		$level = 0;
		$levels = [
			T_PUBLIC => 1,
			T_PROTECTED => 2,
			T_PRIVATE => 3,
		];
		while ($ptr = $phpcsFile->findNext(T_CONST, $ptr)) {
			$visibilityPointer = $phpcsFile->findPrevious([T_PRIVATE, T_PROTECTED, T_PUBLIC], (int)$ptr);
			$visibilityToken = $tokens[$visibilityPointer];
			$currentLevel = $levels[$visibilityToken['code']];
			if ($level > $currentLevel) {
				$phpcsFile->addError(
					'Invalid constant sorting. Correct sorting order: public, protected and private.',
					$stackPtr,
					self::CODE_INCORRECTLY_SORTED_VISIBILITY
				);
			}
			$level = $currentLevel;
			$ptr++;
		}
		return count($phpcsFile->getTokens()) + 1;
	}
}
