# PHPUnit-Expect
![Release](https://img.shields.io/packagist/v/cedx/phpunit-expect.svg) ![License](https://img.shields.io/packagist/l/cedx/phpunit-expect.svg) ![Downloads](https://img.shields.io/packagist/dt/cedx/phpunit-expect.svg) ![Coverage](https://coveralls.io/repos/github/cedx/phpunit-expect/badge.svg) ![Build](https://travis-ci.org/cedx/phpunit-expect.svg)

[BDD](https://en.wikipedia.org/wiki/Behavior-driven_development) assertion library based on [PHPUnit](https://phpunit.de).

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require --dev cedx/phpunit-expect
```

## Usage

### Language chains
The following are provided as chainable getters to improve the readability of your assertions.
They do not provide testing capabilities.

- `and`
- `at`
- `be`
- `been`
- `has`
- `have`
- `is`
- `of`
- `same`
- `that`
- `to`
- `which`
- `with`

### `->not`
Negates any of assertions following in the chain:

```php
expect($foo)->to->not->equal('bar');
expect($goodFn)->to->not->throw(\Exception::class);
expect(['foo' => 'baz'])->to->have->property('foo')->and->not->equal('bar');
```

### `->a(type)` / `->an(type)`
The `a` and `an` assertions are aliases that can be used either as language chains or to assert a value's type:

```php
// As `typeof` operator.
expect(123)->to->be->a('int');
expect(123.456)->to->be->a('float');
expect('123.456')->to->be->a('numeric');
expect('test')->to->be->a('string');

expect(['foo' => 'baz'])->to->be->an('array');
expect(null)->to->be->a('null');
expect(new \Exception())->to->be->an('object');

// As language chain.
expect($foo)->to->be->an->instanceof(\Foo::class);
```

## See also
- [Code coverage](https://coveralls.io/github/cedx/phpunit-expect)
- [Continuous integration](https://travis-ci.org/cedx/phpunit-expect)

## License
[PHPUnit-Expect](https://github.com/cedx/phpunit-expect) is distributed under the Apache License, version 2.0.
