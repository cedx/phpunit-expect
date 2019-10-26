<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{TestCase};

/** A sample assertion class. */
class SampleAssertion {
  use ChainableTrait;
}

/** @testdox PHPUnit\Expect\ChainableTrait */
class ChainableTraitTest extends TestCase {

  /** @testdox ->__get() */
  function testGet(): void {
    $methods = (new \ReflectionClass(SampleAssertion::class))->getMethods(\ReflectionMethod::IS_PUBLIC);
    $filter = fn(\ReflectionMethod $method) => mb_substr($method->getName(), 0, 2) != '__';
    $map = fn(\ReflectionMethod $method) => $method->getName();
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

  /** @testdox ->and() */
  function testAnd(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->and(), identicalTo($assertion));
  }

  /** @testdox ->at() */
  function testAt(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->at(), identicalTo($assertion));
  }

  /** @testdox ->be() */
  function testBe(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->be(), identicalTo($assertion));
  }

  /** @testdox ->been() */
  function testBeen(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->been(), identicalTo($assertion));
  }

  /** @testdox ->but() */
  function testBut(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->but(), identicalTo($assertion));
  }

  /** @testdox ->does() */
  function testDoes(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->does(), identicalTo($assertion));
  }

  /** @testdox ->has() */
  function testHas(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->has(), identicalTo($assertion));
  }

  /** @testdox ->have() */
  function testHave(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->have(), identicalTo($assertion));
  }

  /** @testdox ->is() */
  function testIs(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->is(), identicalTo($assertion));
  }

  /** @testdox ->of() */
  function testOf(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->of(), identicalTo($assertion));
  }

  /** @testdox ->same() */
  function testSame(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->same(), identicalTo($assertion));
  }

  /** @testdox ->still() */
  function testStill(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->still(), identicalTo($assertion));
  }

  /** @testdox ->that() */
  function that(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->that(), identicalTo($assertion));
  }

  /** @testdox ->to() */
  function testTo(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->to(), identicalTo($assertion));
  }

  /** @testdox ->which() */
  function testWhich(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->which(), identicalTo($assertion));
  }

  /** @testdox ->with() */
  function testWith(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    assertThat($assertion->with(), identicalTo($assertion));
  }
}
