# Installation

## Requirements
Before installing **PHPUnit-Expect**, you need to make sure you have [PHP](https://www.php.net)
and [Composer](https://getcomposer.org), the PHP package manager, up and running.
    
You can verify if you're already good to go with the following commands:

```shell
php --version
# PHP 7.4.5 (cli) (built: Apr 14 2020 16:17:19) ( NTS Visual C++ 2017 x64 )

composer --version
# Composer version 1.10.5 2020-04-10 11:44:22
```

?> If you plan to play with the package sources, you will also need the latest version of [Robo](https://robo.li).

## Installing with Composer package manager

### 1. Install it
From a command prompt, run:

```shell
composer require cedx/phpunit-expect
```

### 2. Import it
Now in your [PHP](https://www.php.net) code, you can use:

```php
<?php
use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, fail, it, skip};
```
