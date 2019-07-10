<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{AssertionFailedError, TestCase};

/** Tests the features of the functions. */
class FunctionsTest extends TestCase {

  /** @test expect() */
  function testExpect(): void {
    // It should create new assertions.
    assertThat(expect('foo', 'bar'), isInstanceOf(Assertion::class));
    assertThat(expect(null), logicalNot(identicalTo(expect(null))));
  }

  /** @test fail() */
  function testFail(): void {
    // It should throw an assertion error.
    $this->expectException(AssertionFailedError::class);
    fail('foo');
  }

  /** @test it() */
  function testIt(): void {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    it('foo', $block);
    assertThat($called, isTrue());
  }

  /** @test skip() */
  function testSkip(): void {
    // It should not run its test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    skip('foo', $block);
    assertThat($called, isFalse());
  }
}
