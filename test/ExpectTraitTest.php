<?php
declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert, TestCase};

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
    Assert::assertThat($test->expect('foo', 'bar'), Assert::isInstanceOf(Assertion::class));
    Assert::assertThat($test->expect(null), Assert::logicalNot(Assert::identicalTo($test->expect(null))));
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
    Assert::assertThat($called, Assert::isTrue());
  }

  /**
   * @test Expect::skip
   */
  public function testSkip() {
    // It should not run its test block.
    $called = false;
    $block = function() use (&$called) { $called = true; };

    /** @var ExpectTrait $test */
    $test = $this->getMockForTrait(ExpectTrait::class);
    $test->skip('foo', $block);
    Assert::assertThat($called, Assert::isFalse());
  }
}
