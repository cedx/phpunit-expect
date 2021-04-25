# Flags

## ->**directory**
Sets the `directory` flag, and indicates that the assertions following in the chain target a directory:

```php
use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, it};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be a writable directory', function() {
      expect('path/to/directory')->directory->to->be->writable;
    });
  }
}
```

## ->**file**
Sets the `file` flag, and indicates that the assertions following in the chain target a file:

```php
use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, it};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be a readable file', function() {
      expect('path/to/file')->file->to->be->readable;
    });
  }
}
```

## ->**json**
Sets the `json` flag, and indicates that the assertions following in the chain target a [JSON](https://www.json.org) document:

```php
// TODO: code sample.
```

## ->**length**

?> **Alias:** ->lengthOf

Sets the `length` flag, and indicates that the assertions following in the chain target a length:

```php
use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, it};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be writable', function() {
      expect('foo')->to->have->length->above(2);
      expect([1, 2, 3])->to->have->length->below(4);
      expect('foo')->to->have->lengthOf->at->least(3);
      expect([1, 2, 3])->to->have->lengthOf->at->most(3);
      expect('foo')->to->have->length->within(2, 4);
    });
  }
}
```

## ->**not**
Sets the `negate` flag, and negates any of assertions following in the chain:

```php
use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, it};

class SampleTest extends TestCase {
  function testSomeMethod(): void {
    it('should be negatable', function() {
      expect('foo')->to->not->equal('bar');
      expect(function() {})->to->not->throw;
    });
  }
}
```

?> Just because you can negate any assertion with `->not` doesn't mean you should.
It's often best to assert that the one expected output was produced, rather than asserting that one of countless unexpected outputs wasn't produced.

## ->**ordered**
Sets the `ordered` flag, later used by the `members` assertions:

```php
// TODO: code sample.
```

## ->**xml**
Sets the `xml` flag, and indicates that the assertions following in the chain target an [XML](https://www.w3.org/XML) document:

```php
// TODO: code sample.
```
