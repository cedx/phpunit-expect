<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{TestCase};

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
    static::assertSame($assertion, $assertion->and());
    static::assertSame($assertion, $assertion->at());
    static::assertSame($assertion, $assertion->be());
    static::assertSame($assertion, $assertion->been());
    static::assertSame($assertion, $assertion->but());
    static::assertSame($assertion, $assertion->does());
    static::assertSame($assertion, $assertion->has());
    static::assertSame($assertion, $assertion->have());
    static::assertSame($assertion, $assertion->is());
    static::assertSame($assertion, $assertion->of());
    static::assertSame($assertion, $assertion->same());
    static::assertSame($assertion, $assertion->that());
    static::assertSame($assertion, $assertion->to());
    static::assertSame($assertion, $assertion->which());
    static::assertSame($assertion, $assertion->with());
  }

  /**
   * @test Assertion::todo
   */
  public function testTodo() {
    // TODO
  }
}
