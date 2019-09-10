<?php declare(strict_types = 1);

namespace WavevisionCodingStandard\Sniffs\Structure;

use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class VisibilityOrderSniff implements Sniff
{

	public const INVALID_CONSTANT_ORDER = 'InvalidConstantOrder';

	public const INVALID_STATIC_PROPERTIES_ORDER = 'InvalidStaticPropertiesOrder';

	public const INVALID_MEMBER_ORDER = 'InvalidMemberOrder';


	/**
	 * @return array<mixed>
	 */
	public function register(): array
	{
		return [T_CLASS];
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 * @return void|int
	 */
	public function process(File $phpcsFile, $stackPtr)
	{
		$this->checkConstants($phpcsFile, $stackPtr);
		$this->checkStaticProperties($phpcsFile, $stackPtr);
		$this->checkMembers($phpcsFile, $stackPtr);
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
			'Invalid static properties order',
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
			'Invalid static properties order',
			self::INVALID_STATIC_PROPERTIES_ORDER
		);
	}

	private function checkProperties(
		File $phpcsFile,
		int $stackPtr,
		callable $filter,
		string $message,
		string $code
	): void {
		$members = $this->findMembers($phpcsFile, $stackPtr, $filter);
		$this->checkOrder($members, $phpcsFile, $message, $code);
	}

	/**
	 * @return array<int, int>
	 */
	private function findMembers(File $phpcsFile, int $ptr, callable $callable): array
	{
		$levels = [
			'public' => T_PUBLIC,
			'protected' => T_PROTECTED,
			'private' => T_PRIVATE,
		];
		$members = [];
		while ($ptr = (int)$phpcsFile->findNext(T_VARIABLE, $ptr)) {
			try {
				$member = $phpcsFile->getMemberProperties($ptr);
				if ($callable($member)) {
					$members[$ptr] = $levels[$member['scope']];
				}
			} catch (TokenizerException $ex) {
			}
			$ptr++;
		}
		return $members;
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
