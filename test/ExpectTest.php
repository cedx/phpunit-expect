<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{TestCase};

/**
 * Tests the features of the `PHPUnit\Expect\Expect` trait.
 */
class ExpectTest extends TestCase {

  /**
   * @test Expect::expect
   */
  public function testExpect() {
    // It should create new assertions.
    $test = $this->getMockForTrait(Expect::class);
    assertThat($test->expect('foo', 'bar'), isInstanceOf(Assertion::class));
    assertThat($test->expect(null), logicalNot(identicalTo($test->expect(null))));
  }

  /**
   * @test Expect::it
   */
  public function testIt() {
    // It should invoke the specified test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    $test = $this->getMockForTrait(Expect::class);
    $test->it('foo', $block);
    assertThat($called, isTrue());
  }
}
