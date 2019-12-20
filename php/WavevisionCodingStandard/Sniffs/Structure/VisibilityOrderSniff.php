<?php declare(strict_types = 1);

namespace WavevisionCodingStandard\Sniffs\Structure;

use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class VisibilityOrderSniff implements Sniff
{

	public const INVALID_CONSTANT_ORDER = 'InvalidConstantOrder';

	public const INVALID_STATIC_PROPERTY_ORDER = 'InvalidStaticPropertyOrder';

	public const INVALID_MEMBER_ORDER = 'InvalidMemberOrder';

	public const INVALID_METHOD_ORDER = 'InvalidMethodOrder';

	/**
	 * @return array<mixed>
	 */
	public function register(): array
	{
		return [T_CLASS];
	}

	/**
	 * @param mixed $stackPtr
	 */
	public function process(File $phpcsFile, $stackPtr): void
	{
		$this->checkConstants($phpcsFile, $stackPtr);
		$this->checkStaticProperties($phpcsFile, $stackPtr);
		$this->checkMembers($phpcsFile, $stackPtr);
		$this->checkFunctions($phpcsFile, $stackPtr);
	}

	private function checkFunctions(File $phpcsFile, int $stackPtr): void
	{
		$this->checkBlocks(
			$phpcsFile,
			$stackPtr,
			T_FUNCTION,
			[$phpcsFile, 'getMethodProperties'],
			function () {
				return true;
			},
			'Invalid method order.',
			self::INVALID_METHOD_ORDER
		);
	}

	private function checkConstants(File $phpcsFile, int $stackPtr): void
	{
		$constants = $this->findConstants($phpcsFile, $stackPtr);
		$this->checkOrder($constants, $phpcsFile, 'Invalid constant order.', self::INVALID_CONSTANT_ORDER);
	}

	private function checkMembers(File $phpcsFile, int $stackPtr): void
	{
		$this->checkProperties(
			$phpcsFile,
			$stackPtr,
			function (array $member): bool {
				return !$member['is_static'];
			},
			'Invalid member order.',
			self::INVALID_MEMBER_ORDER
		);
	}

	private function checkStaticProperties(File $phpcsFile, int $stackPtr): void
	{
		$this->checkProperties(
			$phpcsFile,
			$stackPtr,
			function (array $member): bool {
				return $member['is_static'];
			},
			'Invalid static properties order.',
			self::INVALID_STATIC_PROPERTY_ORDER
		);
	}

	private function checkProperties(
		File $phpcsFile,
		int $stackPtr,
		callable $filter,
		string $message,
		string $code
	): void {
		$this->checkBlocks(
			$phpcsFile,
			$stackPtr,
			T_VARIABLE,
			[$phpcsFile, 'getMemberProperties'],
			$filter,
			$message,
			$code
		);
	}

	private function checkBlocks(
		File $phpcsFile,
		int $stackPtr,
		int $token,
		callable $get,
		callable $filter,
		string $message,
		string $code
	): void {
		$members = $this->findBlocks($phpcsFile, $stackPtr, $token, $get, $filter);
		$this->checkOrder($members, $phpcsFile, $message, $code);
	}

	/**
	 * @return array<int, int>
	 */
	private function findBlocks(File $phpcsFile, int $ptr, int $token, callable $get, callable $include): array
	{
		$levels = [
			'public' => T_PUBLIC,
			'protected' => T_PROTECTED,
			'private' => T_PRIVATE,
		];
		$blocks = [];
		while ($ptr = (int)$phpcsFile->findNext($token, $ptr)) {
			try {
				$block = $get($ptr);
				if ($include($block)) {
					$blocks[$ptr] = $levels[$block['scope']];
				}
			} catch (TokenizerException | RuntimeException $ex) {
				//todo better
			}
			$ptr++;
		}
		return $blocks;
	}

	/**
	 * @return array<int, int>
	 */
	private function findConstants(File $phpcsFile, int $stackPtr): array
	{
		$tokens = $phpcsFile->getTokens();
		$constants = [];
		while ($stackPtr = (int)$phpcsFile->findNext(T_CONST, $stackPtr)) {
			$visibilityPointer = $phpcsFile->findPrevious([T_PRIVATE, T_PROTECTED, T_PUBLIC], $stackPtr);
			$visibilityToken = $tokens[$visibilityPointer];
			$constants[$stackPtr++] = $visibilityToken['code'];
		}
		return $constants;
	}

	/**
	 * @param array<int, int> $items
	 */
	private function checkOrder(array $items, File $phpcsFile, string $message, string $code): void
	{
		$level = 0;
		$levels = [
			T_PUBLIC => 1,
			T_PROTECTED => 2,
			T_PRIVATE => 3,
		];
		foreach ($items as $ptr => $visibility) {
			$currentLevel = $levels[$visibility];
			if ($level > $currentLevel) {
				$phpcsFile->addError(
					"$message Correct order: public, protected and private.",
					$ptr,
					$code
				);
			}
			$level = $currentLevel;
		}
	}

}
