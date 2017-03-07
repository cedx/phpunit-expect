<?php
/**
 * Implementation of the `PHPUnit\Expect\AssertionTest` class.
 */
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
    it('should return the current instance', function() {
      $assertion = new Assertion(null);
      expect($assertion)->to->be->identicalTo($assertion);
    });
  }

  /**
   * @test Assertion::todo
   */
  public function testTodo() {
    // TODO
  }
}
