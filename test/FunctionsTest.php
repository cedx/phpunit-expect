<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert as a, AssertionFailedError, TestCase};

/**
 * Tests the features of the functions.
 */
class FunctionsTest extends TestCase {

  /**
   * @test ::expect
   */
  public function testExpect() {
    // It should create new assertions.
    a::assertThat(expect('foo', 'bar'), a::isInstanceOf(Assertion::class));
    a::assertThat(expect(null), a::logicalNot(a::identicalTo(expect(null))));
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
    a::assertThat($called, a::isTrue());
  }
}
