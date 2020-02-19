<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert, TestCase};

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
      Assert::assertThat($assertion->__get($name), Assert::identicalTo($assertion));
      Assert::assertThat($assertion->$name, Assert::identicalTo($assertion));
    }

    // It should throw an exception if there is no method with the given name.
    $this->expectException(\InvalidArgumentException::class);
    $assertion->__get('foo');
  }

  /** @testdox ->and() */
  function testAnd(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->and(), Assert::identicalTo($assertion));
  }

  /** @testdox ->at() */
  function testAt(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->at(), Assert::identicalTo($assertion));
  }

  /** @testdox ->be() */
  function testBe(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->be(), Assert::identicalTo($assertion));
  }

  /** @testdox ->been() */
  function testBeen(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->been(), Assert::identicalTo($assertion));
  }

  /** @testdox ->but() */
  function testBut(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->but(), Assert::identicalTo($assertion));
  }

  /** @testdox ->does() */
  function testDoes(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->does(), Assert::identicalTo($assertion));
  }

  /** @testdox ->has() */
  function testHas(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->has(), Assert::identicalTo($assertion));
  }

  /** @testdox ->have() */
  function testHave(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->have(), Assert::identicalTo($assertion));
  }

  /** @testdox ->is() */
  function testIs(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->is(), Assert::identicalTo($assertion));
  }

  /** @testdox ->of() */
  function testOf(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->of(), Assert::identicalTo($assertion));
  }

  /** @testdox ->same() */
  function testSame(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->same(), Assert::identicalTo($assertion));
  }

  /** @testdox ->still() */
  function testStill(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->still(), Assert::identicalTo($assertion));
  }

  /** @testdox ->that() */
  function that(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->that(), Assert::identicalTo($assertion));
  }

  /** @testdox ->to() */
  function testTo(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->to(), Assert::identicalTo($assertion));
  }

  /** @testdox ->which() */
  function testWhich(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->which(), Assert::identicalTo($assertion));
  }

  /** @testdox ->with() */
  function testWith(): void {
    // It should return the current instance.
    $assertion = new SampleAssertion;
    Assert::assertThat($assertion->with(), Assert::identicalTo($assertion));
  }
}
