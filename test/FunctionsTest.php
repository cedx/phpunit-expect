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
    assertThat(expect('foo', 'bar'), isInstanceOf(Assertion::class));
    assertThat(expect(null), logicalNot(identicalTo(expect(null))));
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
    assertThat($called, isTrue());
  }
}
