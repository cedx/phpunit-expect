<?php declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert, AssertionFailedError, TestCase};

/** @testdox PHPUnit\Expect\Assertion */
class AssertionTest extends TestCase {

  /** @testdox Language chains */
  function testLanguageChains(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    Assert::assertThat($assertion->and, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->at, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->be, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->been, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->but, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->does, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->has, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->have, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->is, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->of, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->same, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->still, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->that, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->to, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->which, Assert::identicalTo($assertion));
    Assert::assertThat($assertion->with, Assert::identicalTo($assertion));
  }

  /** @testdox ->a() */
  function testA(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    Assert::assertThat($assertion->a(), Assert::identicalTo($assertion));
    Assert::assertThat($assertion->an(), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(null))->a('null');
    (new Assertion(true))->a('boolean');

    (new Assertion(123))->an('integer');
    (new Assertion(123.0))->a('float');
    (new Assertion('123'))->a('numeric');

    (new Assertion([]))->an('array');
    (new Assertion(new \stdClass))->an('object');
    (new Assertion('foo'))->a('string');

    // It should be negatable.
    (new Assertion(new \stdClass))->not->an('array');
    (new Assertion([]))->not->an('object');
    (new Assertion(0xAF))->not->a('string');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(null))->an('integer');
  }

  /** @testdox ->above() */
  function testAbove(): void {
    // It should return the current instance.
    $assertion = new Assertion(456);
    Assert::assertThat($assertion->above(123), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(1))->above(0.0);
    (new Assertion(456.0))->above(123);

    // It should handle the length of iterables.
    (new Assertion('foo'))->to->have->length->above(2);
    (new Assertion([1, 2, 3]))->to->have->length->above(2);

    // It should be negatable.
    (new Assertion(123))->not->above(456);

    (new Assertion('foo'))->to->not->have->length->above(3);
    (new Assertion([1, 2, 3]))->to->not->have->length->above(3);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(123))->above(456);
  }

  /** @testdox ->below() */
  function testBelow(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    Assert::assertThat($assertion->below(456), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(0))->below(1.0);
    (new Assertion(123.0))->below(456);

    // It should handle the length of iterables.
    (new Assertion('foo'))->to->have->length->below(4);
    (new Assertion([1, 2, 3]))->to->have->length->below(4);

    // It should be negatable.
    (new Assertion(456))->not->below(123);

    (new Assertion('foo'))->to->not->have->length->below(3);
    (new Assertion([1, 2, 3]))->to->not->have->length->below(3);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->below(123);
  }

  /** @testdox ->closeTo() */
  function testCloseTo(): void {
    // It should return the current instance.
    $assertion = new Assertion(1);
    Assert::assertThat($assertion->closeTo(1, 0.1), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(0))->closeTo(1.0, 2);
    (new Assertion(123.0))->closeTo(123.4, 0.5);

    // It should be negatable.
    (new Assertion(123.0))->not->closeTo(123.4, 0.2);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->closeTo(123, 10);
  }

  /** @testdox ->directory() */
  function testDirectory(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `directory` flag disabled before being called.
    Assert::assertThat($hasFlag('directory'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->directory(), Assert::identicalTo($assertion));

    // It should have its `directory` flag enabled after being called.
    Assert::assertThat($hasFlag('directory'), Assert::isTrue());
  }

  /** @testdox ->empty() */
  function testEmpty(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    Assert::assertThat($assertion->empty, Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(false))->empty;
    (new Assertion(0))->empty;
    (new Assertion(0.0))->empty;
    (new Assertion(''))->empty;
    (new Assertion([]))->empty;
    (new Assertion(new \stdClass))->empty;

    // It should be negatable.
    (new Assertion(true))->not->empty;
    (new Assertion(1))->not->empty;
    (new Assertion(123.0))->not->empty;
    (new Assertion('0'))->not->empty;
    (new Assertion([1, 2, 3]))->not->empty;

    $object = new \stdClass;
    $object->foo = 'bar';
    (new Assertion($object))->not->empty;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(true))->empty;
  }

  /** @testdox ->endWith() */
  function testEndWith(): void {
    // It should return the current instance.
    $assertion = new Assertion('abc');
    Assert::assertThat($assertion->endWith('abc'), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion('abc'))->endWith('c');
    (new Assertion('foo'))->endWith('oo');

    // It should be negatable.
    (new Assertion('abc'))->not->endWith('xyz');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('abc'))->endWith('xyz');
  }

  /** @testdox ->equal() */
  function testEqual(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    Assert::assertThat($assertion->equal(123), Assert::identicalTo($assertion));
    Assert::assertThat($assertion->equals(123), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(false))->equal(false)->equal(0)->equal(0.0);
    (new Assertion(true))->equal(true)->equal(1)->equal(1.0);

    (new Assertion(1))->equal(1.0);
    (new Assertion('foo'))->equal('foo');
    (new Assertion([1, 2, 3]))->equal([1, 2, 3]);

    // It should be negatable.
    (new Assertion(false))->not->equal(true);
    (new Assertion(0))->not->equal(1);
    (new Assertion(2.0))->not->equal(2.1);
    (new Assertion('123'))->not->equal(' 123 ');
    (new Assertion([1, 2, 3]))->not->equal([1, 2]);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->equal(true);
  }

  /** @testdox ->false() */
  function testFalse(): void {
    // It should return the current instance.
    $assertion = new Assertion(false);
    Assert::assertThat($assertion->false, Assert::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(true))->not->false;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(true))->false;
  }

  /** @testdox ->file() */
  function testFile(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `file` flag disabled before being called.
    Assert::assertThat($hasFlag('file'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->file(), Assert::identicalTo($assertion));

    // It should have its `file` flag enabled after being called.
    Assert::assertThat($hasFlag('file'), Assert::isTrue());
  }

  /** @testdox ->include() */
  function testInclude(): void {
    // It should return the current instance.
    $assertion = new Assertion('foobar');
    Assert::assertThat($assertion->contain('foo'), Assert::identicalTo($assertion));
    Assert::assertThat($assertion->contains('foo'), Assert::identicalTo($assertion));
    Assert::assertThat($assertion->include('bar'), Assert::identicalTo($assertion));
    Assert::assertThat($assertion->includes('bar'), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion([1, 2, 3]))->include(2);
    (new Assertion(['a', 'b', 'c']))->include('c');
    (new Assertion(['foo' => 123, 'bar' => 456]))->include(123);

    // It should be negatable.
    (new Assertion('foo'))->not->contain('bar');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('foo'))->contain('abc');
  }

  /** @testdox ->json() */
  function testJson(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `json` flag disabled before being called.
    Assert::assertThat($hasFlag('json'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->json(), Assert::identicalTo($assertion));

    // It should have its `json` flag enabled after being called.
    Assert::assertThat($hasFlag('json'), Assert::isTrue());
  }

  /** @testdox ->least() */
  function testLeast(): void {
    // It should return the current instance.
    $assertion = new Assertion(456);
    Assert::assertThat($assertion->least(123), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(123))->least(123);
    (new Assertion(456))->least(123);

    // It should handle the length of iterables.
    (new Assertion('foo'))->to->have->length->of->at->least(3);
    (new Assertion([1, 2, 3]))->to->have->length->of->at->least(3);

    // It should be negatable.
    (new Assertion(123))->not->least(456);

    (new Assertion('foo'))->to->not->have->length->of->at->least(4);
    (new Assertion([1, 2, 3]))->to->not->have->length->of->at->least(4);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(123))->least(456);
  }

  /** @testdox ->length() */
  function testLength(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `length` flag disabled before being called.
    Assert::assertThat($hasFlag('length'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->length, Assert::identicalTo($assertion));

    // It should have its `length` flag enabled after being called.
    Assert::assertThat($hasFlag('length'), Assert::isTrue());
  }

  /** @testdox ->most() */
  function testMost(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    Assert::assertThat($assertion->most(456), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(123))->most(123);
    (new Assertion(123))->most(456);

    // It should handle the length of iterables.
    (new Assertion('foo'))->to->have->length->of->at->most(3);
    (new Assertion([1, 2, 3]))->to->have->length->of->at->most(3);

    // It should be negatable.
    (new Assertion(456))->not->most(123);

    (new Assertion('foo'))->to->not->have->length->of->at->most(2);
    (new Assertion([1, 2, 3]))->to->not->have->length->of->at->most(2);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->most(123);
  }

  /** @testdox ->NaN() */
  function testNaN(): void {
    // It should return the current instance.
    $assertion = new Assertion(NAN);
    Assert::assertThat($assertion->NaN, Assert::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(123))->not->NaN;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(123))->NaN;
  }

  /** @testdox ->not() */
  function testNot(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `negate` flag disabled before being called.
    Assert::assertThat($hasFlag('negate'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->not, Assert::identicalTo($assertion));

    // It should have its `negate` flag enabled after being called.
    Assert::assertThat($hasFlag('negate'), Assert::isTrue());
  }

  /** @testdox ->null() */
  function testNull(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    Assert::assertThat($assertion->null, Assert::identicalTo($assertion));

    // It should be negatable.
    (new Assertion('foo'))->not->null;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('foo'))->null;
  }

  /** @testdox ->property() */
  function testProperty(): void {
    $array = ['foo' => 'bar'];

    $object = new \stdClass;
    $object->foo = 'bar';

    // It should return the current instance.
    $assertion = new Assertion($array);
    Assert::assertThat($assertion->property('foo'), Assert::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion($array))->property('foo', 'bar');

    (new Assertion($object))->property('foo');
    (new Assertion($object))->property('foo', 'bar');

    // It should be negatable.
    (new Assertion($array))->not->property('bar');
    (new Assertion($array))->not->property('bar', 'bar');
    (new Assertion($array))->not->property('foo', 'baz');

    (new Assertion($object))->not->property('bar');
    (new Assertion($object))->not->property('bar', 'bar');
    (new Assertion($object))->not->property('foo', 'baz');

    // It should changes the subject of the assertion to be the value of that property.
    $data = [
      'foo' => 'bar',
      'bar' => $array,
      'baz' => $object
    ];

    (new Assertion($data))->property('foo')
      ->that->is->a('string')
      ->that->equals('bar');

    (new Assertion($data))->property('bar')
      ->that->is->an('array')
      ->that->equals($array);

    (new Assertion($data))->property('baz')
      ->that->is->an('object')
      ->with->property('foo')->that->equals('bar');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(['foo' => 'bar']))->property('bar');
  }

  /** @testdox ->true() */
  function testTrue(): void {
    // It should return the current instance.
    $assertion = new Assertion(true);
    Assert::assertThat($assertion->true, Assert::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(false))->not->true;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->true;
  }

  /** @testdox ->writable() */
  function testWritable(): void {
    // It should return the current instance.
    $assertion = (new Assertion(__FILE__))->file;
    Assert::assertThat($assertion->writable, Assert::identicalTo($assertion));

    // It should be negatable.
    (new Assertion('null'))->file->not->writable;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('null'))->file->writable;
  }

  /** @testdox ->xml() */
  function testXml(): void {
    $assertion = new Assertion(null);
    $hasFlag = (fn(string $name) => $this->hasFlag($name))->bindTo($assertion, Assertion::class);

    // It should have its `xml` flag disabled before being called.
    Assert::assertThat($hasFlag('xml'), Assert::isFalse());

    // It should return the current instance.
    Assert::assertThat($assertion->xml, Assert::identicalTo($assertion));

    // It should have its `xml` flag enabled after being called.
    Assert::assertThat($hasFlag('xml'), Assert::isTrue());
  }
}
