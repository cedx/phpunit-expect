# Functions

## `expect(mixed $value, string $message = ''): \PHPUnit\Expect\Assertion`
Creates a new `PHPUnit\Expect\Assertion` that let you use a chainable language to construct assertions.

```php
<?php
use function PHPUnit\Expect\{expect};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    echo get_class(expect('fooBar'));
    // PHPUnit\Expect\Assertion
    
    expect(false)->to->not->be->true;
    expect(123)->to->equal(123)->and->be->above(100);
    expect('foo')->to->be->a('string')->and->have->lengthOf(3);
  }
}
```

## `fail(string $message = ''): void`
Fails a test with a given message.

```php
<?php
use function PHPUnit\Expect\{fail};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    fail('An error should have been thrown: the test failed');
  }
}
```

## `it(string $specification, callable $block): void`
Provides the specification of a test block.

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    it('should not be empty', function() {
      expect([123])->to->not->be->empty;
      expect('foo')->to->not->be->empty;
    });
  }
}
```

## `skip(string $specification, callable $block): void`
Skips a test block.

```php
<?php
use function PHPUnit\Expect\{expect, skip};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    skip('should not be empty', function() {
      // This test block will be skipped.
    });
  }
}
```
