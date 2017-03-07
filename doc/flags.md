# Flags

## `->directory`
Indicates that the assertions following in the chain target a directory:

```php
expect($path)->directory->to->exists
  ->and->be->writable;
```

## `->file`
Indicates that the assertions following in the chain target a file:

```php
expect($path)->file->to->exists
  ->and->be->readable;
```

## `->length`
Indicates that the assertions following in the chain target a length:

```php
TODO
```

## `->not`
Negates any of assertions following in the chain:

```php
expect($foo)->to->not->equal('bar');
expect($goodFn)->to->not->throw(\Exception::class);
```
