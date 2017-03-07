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
expect($foo)->to->be->an->instanceof(\Foo::class);
```

## `->include(mixed $value)` / `->contain(mixed $value)`
The `include` and `contain` assertions can be used as either property based language chains or as methods to assert the inclusion of an object in an array or a substring in a string. When used as language chains, they toggle the `contains` flag for the `keys` assertion.

```php
expect([1,2,3])->to->include(2);
expect('foobar')->to->contain('foo');
expect(['foo' => 'bar', 'hello' => 'universe'])->to->include->keys('foo');
```

## `->true`
Asserts that the target is `true`.

```php
expect(true)->to->be->true;
expect(1)->to->not->be->true;
```

## `->false`
Asserts that the target is `false`.

```php
expect(false)->to->be->false;
expect(0)->to->not->be->false;
```

## `->null`
Asserts that the target is `null`.

```php
expect(null)->to->be->null;
expect(false)->to->not->be->null;
```

## `->NaN`
Asserts that the target is `NAN` (not a number).

```php
expect('foo')->to->be->NaN;
expect(4)->to->not->be->NaN;
```

## `->empty`
Asserts that the target's length is `0`. For arrays and strings, it checks the length. For objects, it gets the count of accessible properties.

```php
expect([])->to->be->empty;
expect('')->to->be->empty;
expect(new \stdClass())->to->be->empty;
```

## `->equal(mixed $value)`
Asserts that the target is equal (`==`) to value. Alternately, if the `deep` flag is set, asserts that the target is deeply equal to the specified value.

```php
expect('hello')->to->equal('hello');
expect(42)->to->equal(42);
expect(1)->to->not->equal(true);
```
