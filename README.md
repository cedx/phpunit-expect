# PHPUnit-Expect
![Runtime](https://img.shields.io/badge/php-%3E%3D7.0-brightgreen.svg) ![Release](https://img.shields.io/packagist/v/cedx/phpunit-expect.svg) ![License](https://img.shields.io/packagist/l/cedx/phpunit-expect.svg) ![Downloads](https://img.shields.io/packagist/dt/cedx/phpunit-expect.svg) ![Coverage](https://coveralls.io/repos/github/cedx/phpunit-expect/badge.svg) ![Build](https://travis-ci.org/cedx/phpunit-expect.svg)

[BDD](https://en.wikipedia.org/wiki/Behavior-driven_development) assertion library based on [PHPUnit](https://phpunit.de).

## Installing via [Composer](https://getcomposer.org)
From a command prompt, run:

```shell
$ composer require --dev cedx/phpunit-expect
```

## Usage
- [Functions](doc/functions.md): the `it()` and `expect()` functions, the `await` factory, ...
- [Language chains](doc/chains.md): `->to`, `->be`, ..., `->and`, `->have`, ...
- [Flags](doc/flags.md): `->file`, `--json`, `->length`, `->not`, ...
- [Assertions](doc/assertions.md): `->empty`, `->include()`, `->lengthOf()`, `->throw`...

## See also
- [API reference](https://cedx.github.io/phpunit-expect)
- [Code coverage](https://coveralls.io/github/cedx/phpunit-expect)
- [Continuous integration](https://travis-ci.org/cedx/phpunit-expect)

## License
[PHPUnit-Expect](https://github.com/cedx/phpunit-expect) is distributed under the Apache License, version 2.0.
