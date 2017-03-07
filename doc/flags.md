# Flags

## `->not`
Negates any of assertions following in the chain:

```php
expect($foo)->to->not->equal('bar');
expect($goodFn)->to->not->throw(\Exception::class);
expect(['foo' => 'baz'])->to->have->property('foo')->and->not->equal('bar');
```
