# Flags

## `->directory`
Indicates that the assertions following in the chain target a directory:

```php
expect($path)->directory->to->be->writable;
```

## `->file`
Indicates that the assertions following in the chain target a file:

```php
expect($path)->file->to->be->readable;
```

## `->length`
Indicates that the assertions following in the chain target a length:

```php
expect('foo')->to->have->length->above(2);
expect([1, 2, 3])->to->have->length->below(4);
expect('foo')->to->have->length->of->at->least(3);
expect([1, 2, 3])->to->have->length->of->at->most(3);
expect('foo')->to->have->length->within(2, 4);
```

## `->not`
Negates any of assertions following in the chain:

```php
expect($foo)->to->not->equal('bar');
expect($goodFn)->to->not->throw;
```
