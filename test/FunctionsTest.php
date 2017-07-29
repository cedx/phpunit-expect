<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert, AssertionFailedError, TestCase};

/**
 * Tests the features of the functions.
 */
class FunctionsTest extends TestCase {

  /**
   * @test expect
   */
  public function testExpect() {
    // It should create new assertions.
    Assert::assertThat(expect('foo', 'bar'), Assert::isInstanceOf(Assertion::class));
    Assert::assertThat(expect(null), Assert::logicalNot(Assert::identicalTo(expect(null))));
  }

  /**
   * @test fail
   */
  public function testFail() {
    // It should throw an assertion error.
    $this->expectException(AssertionFailedError::class);
    fail('foo');
  }

  /**
   * @test it
   */
  public function testIt() {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) {
      $called = true;
    };

    it('foo', $block);
    Assert::assertThat($called, Assert::isTrue());
  }

  /**
   * @test skip
   */
  public function testSkip() {
    // It should not run its test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    /** @var ExpectTrait $test */
    skip('foo', $block);
    Assert::assertThat($called, Assert::isFalse());
  }
}
