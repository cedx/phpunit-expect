<?php
declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert};

/**
 * Creates a new assertion.
 * @param mixed $target The target of the assertion.
 * @param string $message Message identifying the error generated by the assertion when it fails.
 * @return Assertion The newly created assertion.
 */
function expect($target, string $message = ''): Assertion {
  return new Assertion($target, $message);
}

/**
 * Fails a test with the given message.
 * @param string $message The message explaining the failure.
 */
function fail(string $message = '') {
  Assert::fail($message);
}

/**
 * Provides the specification of a test block.
 * @param string $specification A message describing the test specification.
 * @param callable $block The test block to be invoked.
 */
function it(string $specification, callable $block) {
  call_user_func($block, $specification);
}

/**
 * Skips a test block.
 * @param string $specification A message describing the test specification.
 * @param callable $block The test block to be invoked.
 */
function skip(string $specification, callable $block) {
  // The test block is ignored.
}