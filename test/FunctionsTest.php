<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{AssertionFailedError, TestCase};
use function PHPUnit\Framework\{assertThat, identicalTo, isFalse, isInstanceOf, isTrue, logicalNot};

/** @testdox PHPUnit\Expect\{expect, fail, it, skip} */
class FunctionsTest extends TestCase {

  /** @testdox expect() */
  function testExpect(): void {
    // It should create new assertions.
    assertThat(expect('foo', 'bar'), isInstanceOf(Assertion::class));
    assertThat(expect(null), logicalNot(identicalTo(expect(null))));
  }

  /** @testdox fail() */
  function testFail(): void {
    // It should throw an assertion error.
    $this->expectException(AssertionFailedError::class);
    fail('foo');
  }

  /** @testdox it() */
  function testIt(): void {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    it('foo', $block);
    assertThat($called, isTrue());
  }

  /** @testdox skip() */
  function testSkip(): void {
    // It should not run its test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    skip('foo', $block);
    assertThat($called, isFalse());
  }
}
