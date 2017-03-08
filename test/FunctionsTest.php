<?php
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
    static::assertThat(expect('foo', 'bar'), static::isInstanceOf(Assertion::class));
    static::assertThat(expect(null), static::logicalNot(static::identicalTo(expect(null))));
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
    static::assertThat($called, static::isTrue());
  }
}
