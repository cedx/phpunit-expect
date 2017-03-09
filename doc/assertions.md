# Assertions

## `->a(string $type)` / `->an(string $type)`
The `a` and `an` assertions are aliases that can be used either as language chains or to assert a value's type:

```php
// As `typeof` operator.
expect(123)->to->be->an('int');
expect(123.456)->to->be->a('float');
expect('123.456')->to->be->a('numeric');
expect('test')->to->be->a('string');

expect(null)->to->be->a('null');
expect(['foo' => 'baz'])->to->be->an('array');
expect(new \stdClass())->to->be->an('object');

// As language chain.
expect($foo)->to->be->an->instanceOf(\Foo::class);
```

## `->above(int|float $value)`
Asserts that the target is greater than the specified value.

```php
expect(10)->to->be->above(5);
```

Can also be used in conjunction with `->length` to assert a minimum length:

```php
expect('foo')->to->have->length->above(2);
expect([1, 2, 3])->to->have->length->above(2);
```

## `->below(int|float $value)`
Asserts that the target is less than the specified value.

```php
expect(5)->to->be->below(10);
```

Can also be used in conjunction with `->length` to assert a maximum length:

```php
expect('foo')->to->have->length->below(4);
expect([1, 2, 3])->to->have->length->below(4);
```

## `->empty`
Asserts that the target's length is `0`. For arrays, strings, and `Countable` instances, it checks the length. For objects, it gets the count of accessible properties.

```php
expect([])->to->be->empty;
expect('')->to->be->empty;
expect(new \stdClass())->to->be->empty;
```

## `->equal(mixed $value)`
Asserts that the target is equal (`==`) to value.

```php
expect('hello')->to->equal('hello');
expect(42)->to->equal(42);
expect(1)->to->not->equal(true);
```

## `->false`
Asserts that the target is `false`.

```php
expect(false)->to->be->false;
expect(0)->to->not->be->false;
```

## `->include(mixed $value)` / `->contain(mixed $value)`
The `include` and `contain` assertions can be used as either property based language chains or as methods to assert the inclusion of an object in an array or a substring in a string. When used as language chains, they toggle the `contain` flag for the `keys` assertion.

```php
expect([1,2,3])->to->include(2);
expect('foobar')->to->contain('foo');
expect(['foo' => 'bar', 'hello' => 'universe'])->to->include->keys('foo');
```

## `->least(int|float $value)`
Asserts that the target is greater than or equal to the specified value.

```php
expect(10)->to->be->at->least(10);
```

Can also be used in conjunction with `->length` to assert a minimum length:

```php
expect('foo')->to->have->length->of->at->least(3);
expect([1, 2, 3])->to->have->length->of->at->least(3);
```

## `->lengthOf(int $value)`
Asserts that the target's length has the expected value:

```php
expect([1, 2, 3])->to->have->lengthOf(3);
expect('foobar')->to->have->lengthOf(6);
```

## `->match(string $pattern)`
Asserts that the target matches a regular expression:

```php
expect('foobar')->to->match('/^foo/');
```

## `->most(int|float $value)`
Asserts that the target is less than or equal to the specified value.

```php
expect(5)->to->be->at->most(5);
```

Can also be used in conjunction with `->length` to assert a maximum length:

```php
expect('foo')->to->have->length->of->at->most(3);
expect([1, 2, 3])->to->have->length->of->at->most(3);
```

## `->NaN`
Asserts that the target is `NAN` (not a number).

```php
expect('foo')->to->be->NaN;
expect(4)->to->not->be->NaN;
```

## `->null`
Asserts that the target is `null`.

```php
expect(null)->to->be->null;
expect(false)->to->not->be->null;
```

## `->throw` / `->throw(string $className)`
Asserts that the function target will throw an exception, or a specific type of exception (as determined using `instanceof`).

```php
$badFn = function() { throw new \RuntimeException('This is a bad function.'); };
expect($badFn)->to->throw(\RuntimeException::class);
expect($badFn)->to->throw(\Exception::class);
expect($badFn)->to->throw;

$goodFn = function() { echo 'Hello World!'; };
expect($goodFn)->to->not->throw;
```

## `->true`
Asserts that the target is `true`.

```php
expect(true)->to->be->true;
expect(1)->to->not->be->true;
```
