<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert as a, TestCase};

/**
 * Tests the features of the `PHPUnit\Expect\Assertion` class.
 */
class AssertionTest extends TestCase {

  /**
   * Tests the language chains.
   * @test
   */
  public function testLanguageChains() {
    // It should return the current instance.
    $assertion = new Assertion(null);
    a::assertThat($assertion, a::identicalTo($assertion->and()));
    a::assertThat($assertion, a::identicalTo($assertion->at()));
    a::assertThat($assertion, a::identicalTo($assertion->be()));
    a::assertThat($assertion, a::identicalTo($assertion->been()));
    a::assertThat($assertion, a::identicalTo($assertion->but()));
    a::assertThat($assertion, a::identicalTo($assertion->does()));
    a::assertThat($assertion, a::identicalTo($assertion->has()));
    a::assertThat($assertion, a::identicalTo($assertion->have()));
    a::assertThat($assertion, a::identicalTo($assertion->is()));
    a::assertThat($assertion, a::identicalTo($assertion->of()));
    a::assertThat($assertion, a::identicalTo($assertion->same()));
    a::assertThat($assertion, a::identicalTo($assertion->that()));
    a::assertThat($assertion, a::identicalTo($assertion->to()));
    a::assertThat($assertion, a::identicalTo($assertion->which()));
    a::assertThat($assertion, a::identicalTo($assertion->with()));
  }

  /**
   * @test Assertion::todo
   */
  public function testTodo() {
    // TODO
  }
}
