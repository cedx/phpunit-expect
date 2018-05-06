# Flags

## ->**directory**
Sets the `directory` flag, and indicates that the assertions following in the chain target a directory:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    it('should be a writable directory', function() {
      expect('path/to/directory')->directory->to->be->writable;
    });
  }
}
```

## ->**file**
Sets the `file` flag, and indicates that the assertions following in the chain target a file:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    it('should be a readable file', function() {
      expect('path/to/file')->file->to->be->readable;
    });
  }
}
```

## ->**json**
Sets the `json` flag, and indicates that the assertions following in the chain target a [JSON](https://www.json.org) document:

```php
<?php
// TODO: code sample.
```

## ->**length**

!!! info "Alias"
    ->**lengthOf**

Sets the `length` flag, and indicates that the assertions following in the chain target a length:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    it('should be writable', function() {
      expect('foo')->to->have->length->above(2);
      expect([1, 2, 3])->to->have->length->below(4);
      expect('foo')->to->have->length->of->at->least(3);
      expect([1, 2, 3])->to->have->length->of->at->most(3);
      expect('foo')->to->have->length->within(2, 4);
    });
  }
}
```

## ->**not**
Sets the `negate` flag, and negates any of assertions following in the chain:

```php
<?php
use function PHPUnit\Expect\{expect, it};
use PHPUnit\Framework\{TestCase};

class SampleTest extends TestCase {
  public function testSomeMethod(): void {
    it('should be writable', function() {
      expect('foo')->to->not->equal('bar');
      expect(function() {})->to->not->throw;
    });
  }
}
```

## ->**ordered**
Sets the `ordered` flag, later used by the `members` assertions:

```php
<?php
// TODO: code sample.
```

## ->**xml**
Sets the `xml` flag, and indicates that the assertions following in the chain target an [XML](https://www.w3.org/XML) document:

```php
<?php
// TODO: code sample.
```
