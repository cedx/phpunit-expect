# Assertions

## ->**a**(string **$type**)

!!! info "Alias"
    ->**an**(string **$type**)

The `a` and `an` assertions are aliases that can be used either as language chains or to assert a value's type:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('can be used to check as `typeof` operator', function() {
      // As `typeof` operator.
      expect(false)->to->be->a('bool'); // or "boolean"
      expect(123)->to->be->an('int'); // or "integer"
      expect(123.456)->to->be->a('float'); // or "double", "real"
    
      expect('123.456')->to->be->a('numeric');
      expect('foo')->to->be->a('scalar');
      expect('bar')->to->be->a('string');
      expect(function() {})->to->be->a('callable');
    
      expect(null)->to->be->a('null');
      expect(['foo' => 'baz'])->to->be->an('array');
      expect(new \stdClass)->to->be->an('object');
    });
    
    it('can be used as language chain', function() {
      $foo = new \Foo;
      expect($foo)->to->be->an->instanceOf(\Foo::class);
    });
  }
}
```

## ->**above**(int | float **$value**)
Asserts that the target is greater than the specified value.

```php
<?php
expect(10)->to->be->above(5);
```

Can also be used in conjunction with `->length` to assert a minimum length:

```php
<?php
expect('foo')->to->have->length->above(2);
expect([1, 2, 3])->to->have->length->above(2);
```

## ->**below**(int | float **$value**)
Asserts that the target is less than the specified value.

```php
<?php
xpect(5)->to->be->below(10);
```

Can also be used in conjunction with `->length` to assert a maximum length:

```php
<?php
expect('foo')->to->have->length->below(4);
expect([1, 2, 3])->to->have->length->below(4);
```

## ->**contain**(mixed **$value**)

!!! info "Aliases"
    ->**contains**(mixed **$value**),
    ->**include**(mixed **$value**),
    ->**includes**(mixed **$value**)

The `contain` and `include` assertions can be used as either property based language chains or as methods to assert the inclusion of an object in an array or a substring in a string. When used as language chains, they toggle the `contain` flag for the `keys` assertion.

```php
<?php
expect([1,2,3])->to->include(2);
expect('foobar')->to->contain('foo');
expect(['foo' => 'bar', 'hello' => 'universe'])->to->include->keys('foo');
```

## ->**empty**
Asserts that the target's length is `0`. For arrays, strings, and `Countable` instances, it checks the length. For objects, it gets the count of accessible properties.

```php
<?php
expect([])->to->be->empty;
expect('')->to->be->empty;
expect(new \stdClass)->to->be->empty;
```

## ->**equal**(mixed **$value**)

!!! info "Alias"
    ->**equals**(mixed **$value**)

Asserts that the target is equal (`==`) to value.

```php
<?php
expect('hello')->to->equal('hello');
expect(42)->to->equal(42);
expect(1)->to->not->equal(true);
```

## ->**false**
Asserts that the target is `false`.

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be false', function() {
      expect(false)->to->be->false;
    });

    it('should not be false', function() {
      expect(true)->to->not->be->false;
    });
  }
}
```

## ->**least**(int | float **$value**)
Asserts that the target is greater than or equal to the specified value.

```php
<?php
expect(10)->to->be->at->least(10);
```

Can also be used in conjunction with `->length` to assert a minimum length:

```php
<?php
expect('foo')->to->have->length->of->at->least(3);
expect([1, 2, 3])->to->have->length->of->at->least(3);
```

## ->**lengthOf**(int **$value**)

!!! info "Alias"
    ->**length**(int **$value**)

Asserts that the target's length has the expected value:

```php
<?php
expect([1, 2, 3])->to->have->lengthOf(3);
expect('foobar')->to->have->lengthOf(6);
```

## ->**match**(string **$pattern**)
Asserts that the target matches a regular expression:

```php
<?php
expect('foobar')->to->match('/^foo/');
```

## ->**most**(int | float **$value**)
Asserts that the target is less than or equal to the specified value.

```php
<?php
expect(5)->to->be->at->most(5);
```

Can also be used in conjunction with `->length` to assert a maximum length:

```php
<?php
expect('foo')->to->have->length->of->at->most(3);
expect([1, 2, 3])->to->have->length->of->at->most(3);
```

## ->**NaN**
Asserts that the target is `NAN` (not a number).

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be null', function() {
      expect('foo')->to->be->NaN;
    });

    it('should not be null', function() {
      expect(4)->to->not->be->NaN;
    });
  }
}
```

## ->**null**
Asserts that the target is `null`.

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be null', function() {
      expect(null)->to->be->null;
    });

    it('should not be null', function() {
      expect('foo')->to->not->be->null;
    });
  }
}
```

## ->**property**(string **$name**) / ->**property**(string **$name**, **$value**)
Asserts that the target has a property or a key with the specified name, optionally asserting that the value of that property or key is equal to the specified value:

```php
<?php
$array = ['foo' => 'bar'];
expect($array)->to->have->property('foo');
expect($array)->to->have->property('foo', 'bar');

$object = new \stdClass;
$object->foo = 'bar';
expect($object)->to->have->property('foo');
expect($object)->to->have->property('foo', 'bar');
```

It also changes the subject of the assertion to be the value of that property from the original object. This permits for further chainable assertions on that property:

```php
<?php
expect($value)->to->have->property('foo')
  ->that->is->a('string');
  
expect($value)->to->have->property('bar')
  ->that->is->an('array')
  ->that->equals(['foo' => 'bar']);
  
expect($value)->to->have->property('baz')
  ->that->is->an('object')
  ->with->property('foo')->that->equals('bar');
```

## ->**throw** / ->**throw**(string **$className**)
Asserts that the function target will throw an exception, or a specific type of exception (as determined using `instanceof`):

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should throw an exception', function() {
      $badFn = function() { throw new \RuntimeException('This is a bad function.'); };
      expect($badFn)->to->throw(\RuntimeException::class);
      expect($badFn)->to->throw(\Exception::class);
      expect($badFn)->to->throw;
      expect($badFn)->to->not->throw(\InvalidArgumentException::class);
    });
      
    it('should not throw an exception', function() {
      $goodFn = function() { echo 'Hello World!'; };
      expect($goodFn)->to->not->throw;
    });
  }
}
```

## ->**true**
Asserts that the target is `true`:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be true', function() {
      expect(true)->to->be->true;
    });

    it('should not be true', function() {
      expect(false)->to->not->be->true;
    });
  }
}
```
