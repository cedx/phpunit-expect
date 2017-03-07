<?php
/**
 * Implementation of the `PHPUnit\Expect\FunctionsTest` class.
 */
namespace PHPUnit\Expect;
use PHPUnit\Framework\{AssertionFailedError, TestCase};

/**
 * Tests the features of the provided functions.
 */
class FunctionsTest extends TestCase {

  /**
   * @test ::expect
   */
  public function testExpect() {
    // It should create new assertions.
    static::assertInstanceOf(Assertion::class, expect('foo', 'bar'));
    static::assertNotSame(expect(null), expect(null));
  }

  /**
   * @test ::fail
   */
  public function testFail() {
    // It should throw an assertion error.
    $this->expectException(AssertionFailedError::class);
    fail('foo');
  }

  /**
   * @test ::it
   */
  public function testIt() {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    it('foo', $block);
    static::assertTrue($called);
  }
}
