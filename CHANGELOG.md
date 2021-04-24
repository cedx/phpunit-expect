# Changelog

## Version [0.12.0](https://github.com/cedx/phpunit-expect/compare/v0.11.0...v0.12.0)
- Updated the documentation.
- Updated the package dependencies.

## Version [0.11.0](https://github.com/cedx/phpunit-expect/compare/v0.10.0...v0.11.0)
- Added an example code.
- Updated the package dependencies.

## Version [0.10.0](https://github.com/cedx/phpunit-expect/compare/v0.9.0...v0.10.0)
- Upgraded [PHPUnit](https://phpunit.de) to version 9.

## Version [0.9.0](https://github.com/cedx/phpunit-expect/compare/v0.8.0...v0.9.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: using PHP 7.4 features, like arrow functions and typed properties.

## Version [0.8.0](https://github.com/cedx/phpunit-expect/compare/v0.7.0...v0.8.0)
- The `skip()` function can mark the surrounding test as skipped.
- Updated the package dependencies.

## Version [0.7.0](https://github.com/cedx/phpunit-expect/compare/v0.6.0...v0.7.0)
- Added the `approximately` assertion alias.
- Added the `still` language chain.
- Moved the language chains to a dedicated trait `ChainableTrait`.
- Upgraded [PHPUnit](https://phpunit.de) to version 8.

## Version [0.6.0](https://github.com/cedx/phpunit-expect/compare/v0.5.0...v0.6.0)
- Added support for [PHPStan](https://github.com/phpstan/phpstan) static analyzer.
- Updated the package dependencies.

## Version [0.5.0](https://github.com/cedx/phpunit-expect/compare/v0.4.0...v0.5.0)
- Breaking change: raised the required [PHP](https://www.php.net) version.
- Breaking change: removed the `await()` function.
- Breaking change: using PHP 7.1 features, like void functions.
- Added a user guide based on [MkDocs](http://www.mkdocs.org).
- Added support for [phpDocumentor](https://www.phpdoc.org).
- Updated the package dependencies.

## Version [0.4.0](https://github.com/cedx/phpunit-expect/compare/v0.3.0...v0.4.0)
- Breaking change: removed the `ExpectTrait` trait.
- Added the `await()` function allowing to run asynchronous tests based on the [ReactPHP](http://reactphp.org) event loop.
- Changed licensing for the [MIT License](https://opensource.org/licenses/MIT).

## Version [0.3.0](https://github.com/cedx/phpunit-expect/compare/v0.2.0...v0.3.0)
- Added new test cases.
- Enabled the strict typing.
- Replaced [phpDocumentor](https://www.phpdoc.org) documentation generator by [ApiGen](https://github.com/ApiGen/ApiGen).
- The `skip` API now really skips its test block.
- Updated the package dependencies.

## Version [0.2.0](https://github.com/cedx/phpunit-expect/compare/v0.1.0...v0.2.0)
- Breaking change: moved the functions to the `PHPUnit\Expect` namespace.
- Breaking change: renamed the trait to `ExpectTrait`.
- Added support for the `file` flag in the `contain` and `empty` assertions.
- Fixed a bug in the `Assertion->getLength()` method.
- Updated the dependencies.

## Version 0.1.0
- Initial release.
