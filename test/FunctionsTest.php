<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert, AssertionFailedError, TestCase};

/** @testdox PHPUnit\Expect\{expect, fail, it, skip} */
class FunctionsTest extends TestCase {

  /** @testdox expect() */
  function testExpect(): void {
    // It should create new assertions.
    Assert::assertThat(expect('foo', 'bar'), Assert::isInstanceOf(Assertion::class));
    Assert::assertThat(expect(null), Assert::logicalNot(Assert::identicalTo(expect(null))));
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
    Assert::assertThat($called, Assert::isTrue());
  }

  /** @testdox skip() */
  function testSkip(): void {
    // It should not run its test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    skip('foo', $block);
    Assert::assertThat($called, Assert::isFalse());
  }
}
