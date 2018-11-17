<?php
declare(strict_types=1);
namespace PHPUnit\Expect;

use PHPUnit\Framework\{Assert, AssertionFailedError, TestCase};

/**
 * Tests the features of the `PHPUnit\Expect\Assertion` class.
 */
class AssertionTest extends TestCase {

  /**
   * Tests the `Assertion::a()` method.
   */
  function testA(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    assertThat($assertion->a(), identicalTo($assertion));
    assertThat($assertion->an(), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::above()` method.
   */
  function testAbove(): void {
    // It should return the current instance.
    $assertion = new Assertion(456);
    assertThat($assertion->above(123), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::below()` method.
   */
  function testBelow(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    assertThat($assertion->below(456), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::closeTo()` method.
   */
  function testCloseTo(): void {
    // It should return the current instance.
    $assertion = new Assertion(1);
    assertThat($assertion->closeTo(1, 0.1), identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(0))->closeTo(1.0, 2);
    (new Assertion(123.0))->closeTo(123.4, 0.5);

    // It should be negatable.
    (new Assertion(123.0))->not->closeTo(123.4, 0.2);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->closeTo(123, 10);
  }

  /**
   * Tests the `Assertion::directory()` method.
   */
  function testDirectory(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `directory` flag disabled before being called.
    assertThat($hasFlag('directory'), isFalse());

    // It should return the current instance.
    assertThat($assertion->directory(), identicalTo($assertion));

    // It should have its `directory` flag enabled after being called.
    assertThat($hasFlag('directory'), isTrue());
  }

  /**
   * Tests the `Assertion::empty()` method.
   */
  function testEmpty(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    assertThat($assertion->empty, identicalTo($assertion));

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

  /**
   * Tests the `Assertion::endWith()` method.
   */
  function testEndWith(): void {
    // It should return the current instance.
    $assertion = new Assertion('abc');
    assertThat($assertion->endWith('abc'), identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion('abc'))->endWith('c');
    (new Assertion('foo'))->endWith('oo');

    // It should be negatable.
    (new Assertion('abc'))->not->endWith('xyz');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('abc'))->endWith('xyz');
  }

  /**
   * Tests the `Assertion::equal()` method.
   */
  function testEqual(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    assertThat($assertion->equal(123), identicalTo($assertion));
    assertThat($assertion->equals(123), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::false()` method.
   */
  function testFalse(): void {
    // It should return the current instance.
    $assertion = new Assertion(false);
    assertThat($assertion->false, identicalTo($assertion));

    // It should be negatable.
    (new Assertion(true))->not->false;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(true))->false;
  }

  /**
   * Tests the `Assertion::file()` method.
   */
  function testFile(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `file` flag disabled before being called.
    assertThat($hasFlag('file'), isFalse());

    // It should return the current instance.
    assertThat($assertion->file(), identicalTo($assertion));

    // It should have its `file` flag enabled after being called.
    assertThat($hasFlag('file'), isTrue());
  }

  /**
   * Tests the `Assertion::include()` method.
   */
  function testInclude(): void {
    // It should return the current instance.
    $assertion = new Assertion('foobar');
    assertThat($assertion->contain('foo'), identicalTo($assertion));
    assertThat($assertion->contains('foo'), identicalTo($assertion));
    assertThat($assertion->include('bar'), identicalTo($assertion));
    assertThat($assertion->includes('bar'), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::json()` method.
   */
  function testJson(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `json` flag disabled before being called.
    assertThat($hasFlag('json'), isFalse());

    // It should return the current instance.
    assertThat($assertion->json(), identicalTo($assertion));

    // It should have its `json` flag enabled after being called.
    assertThat($hasFlag('json'), isTrue());
  }

  /**
   * Tests the language chains.
   */
  function testLanguageChains(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    assertThat($assertion->and, identicalTo($assertion));
    assertThat($assertion->at, identicalTo($assertion));
    assertThat($assertion->be, identicalTo($assertion));
    assertThat($assertion->been, identicalTo($assertion));
    assertThat($assertion->but, identicalTo($assertion));
    assertThat($assertion->does, identicalTo($assertion));
    assertThat($assertion->has, identicalTo($assertion));
    assertThat($assertion->have, identicalTo($assertion));
    assertThat($assertion->is, identicalTo($assertion));
    assertThat($assertion->of, identicalTo($assertion));
    assertThat($assertion->same, identicalTo($assertion));
    assertThat($assertion->that, identicalTo($assertion));
    assertThat($assertion->to, identicalTo($assertion));
    assertThat($assertion->which, identicalTo($assertion));
    assertThat($assertion->with, identicalTo($assertion));
  }

  /**
   * Tests the `Assertion::least()` method.
   */
  function testLeast(): void {
    // It should return the current instance.
    $assertion = new Assertion(456);
    assertThat($assertion->least(123), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::length()` method.
   */
  function testLength(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `length` flag disabled before being called.
    assertThat($hasFlag('length'), isFalse());

    // It should return the current instance.
    assertThat($assertion->length, identicalTo($assertion));

    // It should have its `length` flag enabled after being called.
    assertThat($hasFlag('length'), isTrue());
  }

  /**
   * Tests the `Assertion::most()` method.
   */
  function testMost(): void {
    // It should return the current instance.
    $assertion = new Assertion(123);
    assertThat($assertion->most(456), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::NaN()` method.
   */
  function testNaN(): void {
    // It should return the current instance.
    $assertion = new Assertion(NAN);
    assertThat($assertion->NaN, identicalTo($assertion));

    // It should be negatable.
    (new Assertion('123'))->not->NaN;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('123'))->NaN;
  }

  /**
   * Tests the `Assertion::not()` method.
   */
  function testNot(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `negate` flag disabled before being called.
    assertThat($hasFlag('negate'), isFalse());

    // It should return the current instance.
    assertThat($assertion->not, identicalTo($assertion));

    // It should have its `negate` flag enabled after being called.
    assertThat($hasFlag('negate'), isTrue());
  }

  /**
   * Tests the `Assertion::null()` method.
   */
  function testNull(): void {
    // It should return the current instance.
    $assertion = new Assertion(null);
    assertThat($assertion->null, identicalTo($assertion));

    // It should be negatable.
    (new Assertion('foo'))->not->null;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('foo'))->null;
  }

  /**
   * Tests the `Assertion::property()` method.
   */
  function testProperty(): void {
    $array = ['foo' => 'bar'];

    $object = new \stdClass;
    $object->foo = 'bar';

    // It should return the current instance.
    $assertion = new Assertion($array);
    assertThat($assertion->property('foo'), identicalTo($assertion));

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

  /**
   * Tests the `Assertion::true()` method.
   */
  function testTrue(): void {
    // It should return the current instance.
    $assertion = new Assertion(true);
    assertThat($assertion->true, identicalTo($assertion));

    // It should be negatable.
    (new Assertion(false))->not->true;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->true;
  }

  /**
   * Tests the `Assertion::writable()` method.
   */
  function testWritable(): void {
    // It should return the current instance.
    $assertion = (new Assertion(__FILE__))->file;
    assertThat($assertion->writable, identicalTo($assertion));

    // It should be negatable.
    (new Assertion(false))->file->not->writable;

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->file->writable;
  }

  /**
   * Tests the `Assertion::xml()` method.
   */
  function testXml(): void {
    $assertion = new Assertion(null);
    $hasFlag = (function(string $name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `xml` flag disabled before being called.
    assertThat($hasFlag('xml'), isFalse());

    // It should return the current instance.
    assertThat($assertion->xml, identicalTo($assertion));

    // It should have its `xml` flag enabled after being called.
    assertThat($hasFlag('xml'), isTrue());
  }
}
