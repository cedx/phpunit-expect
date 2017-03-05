<?php
/**
 * Implementation of the `PHPUnit\Expect` functions.
 */
use PHPUnit\Expect\{Assertion};
use PHPUnit\Framework\{Assert};

if (!function_exists('expect')) {

  /**
   * Creates a new assertion.
   * @param mixed $target The target of the assertion.
   * @param string $message Message identifying the error generated by the assertion when it fails.
   * @return Assertion The newly created assertion.
   */
  function expect($target, string $message = ''): Assertion {
    return new Assertion($target, $message);
  }
}

if (!function_exists('fail')) {

  /**
   * Fails a test with the given message.
   * @param string $message The message explaining the failure.
   */
  function fail(string $message = '') {
    Assert::fail($message);
  }
}

if (!function_exists('it')) {

  /**
   * Provides the specification of a test block.
   * @param string $specification A message describing the test specification.
   * @param callable $block The test block to be invoked.
   */
  function it(string $specification, callable $block) {
    call_user_func($block, $specification);
  }
}
