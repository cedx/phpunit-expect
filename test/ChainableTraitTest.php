<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{TestCase};

/** A sample assertion class. */
class SampleAssertion {
  use ChainableTrait;
}

/** Tests the features of the `PHPUnit\Expect\ChainableTrait` trait. */
class ChainableTraitTest extends TestCase {

  /** @test ChainableTrait->__get() */
  function testGet(): void {
    $methods = (new \ReflectionClass(SampleAssertion::class))->getMethods(\ReflectionMethod::IS_PUBLIC);
    $filter = function(\ReflectionMethod $method) { return mb_substr($method->getName(), 0, 2) != '__'; };
    $map = function(\ReflectionMethod $method) { return $method->getName(); };
    $names = array_map($map, array_filter($methods, $filter));

    // It should return the current instance.
    $assertion = new SampleAssertion;
    foreach ($names as $name) {
      assertThat($assertion->__get($name), identicalTo($assertion));
      assertThat($assertion->$name, identicalTo($assertion));
    }

    // It should throw an exception if there is no method with the given name.
    $this->expectException(\InvalidArgumentException::class);
    $assertion->__get('foo');
  }

  /** @test ChainableTrait->and() */
  function testAnd(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->and(), identicalTo($assertion));
  }

  /** @test ChainableTrait->at() */
  function testAt(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->at(), identicalTo($assertion));
  }

  /** @test ChainableTrait->be() */
  function testBe(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->be(), identicalTo($assertion));
  }

  /** @test ChainableTrait->been() */
  function testBeen(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->been(), identicalTo($assertion));
  }

  /** @test ChainableTrait->but() */
  function testBut(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->but(), identicalTo($assertion));
  }

  /** @test ChainableTrait->does() */
  function testDoes(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->does(), identicalTo($assertion));
  }

  /** @test ChainableTrait->has() */
  function testHas(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->has(), identicalTo($assertion));
  }

  /** @test ChainableTrait->have() */
  function testHave(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->have(), identicalTo($assertion));
  }

  /** @test ChainableTrait->is() */
  function testIs(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->is(), identicalTo($assertion));
  }

  /** @test ChainableTrait->of() */
  function testOf(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->of(), identicalTo($assertion));
  }

  /** @test ChainableTrait->same() */
  function testSame(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->same(), identicalTo($assertion));
  }

  /** @test ChainableTrait->still() */
  function testStill(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->still(), identicalTo($assertion));
  }

  /** @test ChainableTrait->that() */
  function that(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->that(), identicalTo($assertion));
  }

  /** @test ChainableTrait->to() */
  function testTo(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->to(), identicalTo($assertion));
  }

  /** @test ChainableTrait->which() */
  function testWhich(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->which(), identicalTo($assertion));
  }

  /** @test ChainableTrait->with() */
  function testWith(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->with(), identicalTo($assertion));
  }
}
