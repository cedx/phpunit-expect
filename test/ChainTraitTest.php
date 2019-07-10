<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{TestCase};

/** A sample assertion class. */
final class SampleAssertion {
  use ChainTrait;
}

/** Tests the features of the `PHPUnit\Expect\ChainTrait` trait. */
class ChainTraitTest extends TestCase {

  /** @test ChainTrait->and() */
  function testAnd(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->and(), identicalTo($assertion));
  }

  /** @test ChainTrait->at() */
  function testAt(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->at(), identicalTo($assertion));
  }

  /** @test ChainTrait->be() */
  function testBe(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->be(), identicalTo($assertion));
  }

  /** @test ChainTrait->been() */
  function testBeen(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->been(), identicalTo($assertion));
  }

  /** @test ChainTrait->but() */
  function testBut(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->but(), identicalTo($assertion));
  }

  /** @test ChainTrait->does() */
  function testDoes(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->does(), identicalTo($assertion));
  }

  /** @test ChainTrait->has() */
  function testHas(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->has(), identicalTo($assertion));
  }

  /** @test ChainTrait->have() */
  function testHave(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->have(), identicalTo($assertion));
  }

  /** @test ChainTrait->is() */
  function testIs(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->is(), identicalTo($assertion));
  }

  /** @test ChainTrait->of() */
  function testOf(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->of(), identicalTo($assertion));
  }

  /** @test ChainTrait->same() */
  function testSame(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->same(), identicalTo($assertion));
  }

  /** @test ChainTrait->still() */
  function testStill(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->still(), identicalTo($assertion));
  }

  /** @test ChainTrait->that() */
  function that(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->that(), identicalTo($assertion));
  }

  /** @test ChainTrait->to() */
  function testTo(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->to(), identicalTo($assertion));
  }

  /** @test ChainTrait->which() */
  function testWhich(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->which(), identicalTo($assertion));
  }

  /** @test ChainTrait->with() */
  function testWith(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->with(), identicalTo($assertion));
  }
}
