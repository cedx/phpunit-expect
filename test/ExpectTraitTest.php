<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert as a, TestCase};

/**
 * Tests the features of the `PHPUnit\Expect\ExpectTrait` trait.
 */
class ExpectTraitTest extends TestCase {

  /**
   * @test Expect::expect
   */
  public function testExpect() {
    // It should create new assertions.
    /** @var ExpectTrait $test */
    $test = $this->getMockForTrait(ExpectTrait::class);
    a::assertThat($test->expect('foo', 'bar'), a::isInstanceOf(Assertion::class));
    a::assertThat($test->expect(null), a::logicalNot(a::identicalTo($test->expect(null))));
  }

  /**
   * @test Expect::it
   */
  public function testIt() {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    /** @var ExpectTrait $test */
    $test = $this->getMockForTrait(ExpectTrait::class);
    $test->it('foo', $block);
    a::assertThat($called, a::isTrue());
  }
}