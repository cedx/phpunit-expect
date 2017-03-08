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
    static::assertThat($test->expect('foo', 'bar'), static::isInstanceOf(Assertion::class));
    static::assertThat($test->expect(null), static::logicalNot(static::identicalTo($test->expect(null))));
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
    static::assertThat($called, static::isTrue());
  }
}
