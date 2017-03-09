<?php
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert as a, AssertionFailedError, TestCase};

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
    a::assertThat($assertion->and(), a::identicalTo($assertion));
    a::assertThat($assertion->at(), a::identicalTo($assertion));
    a::assertThat($assertion->be(), a::identicalTo($assertion));
    a::assertThat($assertion->been(), a::identicalTo($assertion));
    a::assertThat($assertion->but(), a::identicalTo($assertion));
    a::assertThat($assertion->does(), a::identicalTo($assertion));
    a::assertThat($assertion->has(), a::identicalTo($assertion));
    a::assertThat($assertion->have(), a::identicalTo($assertion));
    a::assertThat($assertion->is(), a::identicalTo($assertion));
    a::assertThat($assertion->of(), a::identicalTo($assertion));
    a::assertThat($assertion->same(), a::identicalTo($assertion));
    a::assertThat($assertion->that(), a::identicalTo($assertion));
    a::assertThat($assertion->to(), a::identicalTo($assertion));
    a::assertThat($assertion->which(), a::identicalTo($assertion));
    a::assertThat($assertion->with(), a::identicalTo($assertion));
  }

  /**
   * @test Assertion::a
   */
  public function testA() {
    // It should return the current instance.
    $assertion = new Assertion(null);
    a::assertThat($assertion->a(), a::identicalTo($assertion));
    a::assertThat($assertion->an(), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(null))->a('null');
    (new Assertion(true))->a('boolean');

    (new Assertion(123))->an('integer');
    (new Assertion(123.0))->a('float');
    (new Assertion('123'))->a('numeric');

    (new Assertion([]))->an('array');
    (new Assertion(new \stdClass()))->an('object');
    (new Assertion('foo'))->a('string');

    // It should be negatable.
    (new Assertion(new \stdClass()))->not()->an('array');
    (new Assertion([]))->not()->an('object');
    (new Assertion(0xAF))->not()->a('string');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(null))->an('integer');
  }

  /**
   * @test Assertion::above
   */
  public function testAbove() {
    // It should return the current instance.
    $assertion = new Assertion(456);
    a::assertThat($assertion->above(123), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(1))->above(0.0);
    (new Assertion(456.0))->above(123);

    // It should be negatable.
    (new Assertion(123))->not()->above(456);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(123))->above(456);
  }

  /**
   * @test Assertion::below
   */
  public function testBelow() {
    // It should return the current instance.
    $assertion = new Assertion(123);
    a::assertThat($assertion->below(456), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(0))->below(1.0);
    (new Assertion(123.0))->below(456);

    // It should be negatable.
    (new Assertion(456))->not()->below(123);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->below(123);
  }

  /**
   * @test Assertion::directory
   */
  public function testDirectory() {
    $assertion = new Assertion(null);
    $hasFlag = (function($name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `isDirectory` flag disabled before being called.
    a::assertThat($hasFlag('isDirectory'), a::isFalse());

    // It should return the current instance.
    a::assertThat($assertion->directory(), a::identicalTo($assertion));

    // It should have its `isDirectory` flag enabled after being called.
    a::assertThat($hasFlag('isDirectory'), a::isTrue());
  }

  /**
   * @test Assertion::empty
   */
  public function testEmpty() {
    // It should return the current instance.
    $assertion = new Assertion(null);
    a::assertThat($assertion->empty(), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(false))->empty();
    (new Assertion(0))->empty();
    (new Assertion(0.0))->empty();
    (new Assertion(''))->empty();
    (new Assertion([]))->empty();
    (new Assertion(new \stdClass()))->empty();

    // It should be negatable.
    (new Assertion(true))->not()->empty();
    (new Assertion(1))->not()->empty();
    (new Assertion(123.0))->not()->empty();
    (new Assertion('0'))->not()->empty();
    (new Assertion([1, 2, 3]))->not()->empty();

    $object = new \stdClass();
    $object->foo = 'bar';
    (new Assertion($object))->not()->empty();

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(true))->empty();
  }

  /**
   * @test Assertion::equal
   */
  public function testEqual() {
    // It should return the current instance.
    $assertion = new Assertion(123);
    a::assertThat($assertion->equal(123), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(false))->equal(false)->equal(0)->equal(0.0);
    (new Assertion(true))->equal(true)->equal(1)->equal(1.0);

    (new Assertion(1))->equal(1.0);
    (new Assertion('foo'))->equal('foo');
    (new Assertion([1, 2, 3]))->equal([1, 2, 3]);

    // It should be negatable.
    (new Assertion(false))->not()->equal(true);
    (new Assertion(0))->not()->equal(1);
    (new Assertion(2.0))->not()->equal(2.1);
    (new Assertion('123'))->not()->equal(' 123 ');
    (new Assertion([1, 2, 3]))->not()->equal([1, 2]);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->equal(true);
  }

  /**
   * @test Assertion::false
   */
  public function testFalse() {
    // It should return the current instance.
    $assertion = new Assertion(false);
    a::assertThat($assertion->false(), a::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(true))->not()->false();

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(true))->false();
  }

  /**
   * @test Assertion::file
   */
  public function testFile() {
    $assertion = new Assertion(null);
    $hasFlag = (function($name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `isFile` flag disabled before being called.
    a::assertThat($hasFlag('isFile'), a::isFalse());

    // It should return the current instance.
    a::assertThat($assertion->file(), a::identicalTo($assertion));

    // It should have its `isFile` flag enabled after being called.
    a::assertThat($hasFlag('isFile'), a::isTrue());
  }

  /**
   * @test Assertion::include
   */
  public function testInclude() {
    // It should return the current instance.
    $assertion = new Assertion('foobar');
    a::assertThat($assertion->contain('foo'), a::identicalTo($assertion));
    a::assertThat($assertion->include('bar'), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion([1, 2, 3]))->include(2);
    (new Assertion(['a', 'b', 'c']))->include('c');
    (new Assertion(['foo' => 123, 'bar' => 456]))->include(123);

    // It should be negatable.
    (new Assertion('foo'))->not()->contain('bar');

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('foo'))->contain('abc');
  }

  /**
   * @test Assertion::least
   */
  public function testLeast() {
    // It should return the current instance.
    $assertion = new Assertion(456);
    a::assertThat($assertion->least(123), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(123))->least(123);
    (new Assertion(456))->least(123);

    // It should be negatable.
    (new Assertion(123))->not()->least(456);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(123))->least(456);
  }

  /**
   * @test Assertion::length
   */
  public function testLength() {
    $assertion = new Assertion(null);
    $hasFlag = (function($name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `isLength` flag disabled before being called.
    a::assertThat($hasFlag('isLength'), a::isFalse());

    // It should return the current instance.
    a::assertThat($assertion->length(), a::identicalTo($assertion));

    // It should have its `isLength` flag enabled after being called.
    a::assertThat($hasFlag('isLength'), a::isTrue());
  }

  /**
   * @test Assertion::most
   */
  public function testMost() {
    // It should return the current instance.
    $assertion = new Assertion(123);
    a::assertThat($assertion->most(456), a::identicalTo($assertion));

    // It should not throw an exception if the assertion succeeded.
    (new Assertion(123))->most(123);
    (new Assertion(123))->most(456);

    // It should be negatable.
    (new Assertion(456))->not()->most(123);

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(456))->most(123);
  }

  /**
   * @test Assertion::NaN
   */
  public function testNaN() {
    // It should return the current instance.
    $assertion = new Assertion(NAN);
    a::assertThat($assertion->NaN(), a::identicalTo($assertion));

    // It should be negatable.
    (new Assertion('123'))->not()->NaN();

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion('123'))->NaN();
  }

  /**
   * @test Assertion::not
   */
  public function testNot() {
    $assertion = new Assertion(null);
    $hasFlag = (function($name) { return $this->hasFlag($name); })->bindTo($assertion, Assertion::class);

    // It should have its `negate` flag disabled before being called.
    a::assertThat($hasFlag('negate'), a::isFalse());

    // It should return the current instance.
    a::assertThat($assertion->not(), a::identicalTo($assertion));

    // It should have its `negate` flag enabled after being called.
    a::assertThat($hasFlag('negate'), a::isTrue());
  }

  /**
   * @test Assertion::null
   */
  public function testNull() {
    // It should return the current instance.
    $assertion = new Assertion(null);
    a::assertThat($assertion->null(), a::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(new \stdClass()))->not()->null();

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(new \stdClass()))->null();
  }

  /**
   * @test Assertion::true
   */
  public function testTrue() {
    // It should return the current instance.
    $assertion = new Assertion(true);
    a::assertThat($assertion->true(), a::identicalTo($assertion));

    // It should be negatable.
    (new Assertion(false))->not()->true();

    // It should throw an exception if the assertion failed.
    $this->expectException(AssertionFailedError::class);
    (new Assertion(false))->true();
  }
}
