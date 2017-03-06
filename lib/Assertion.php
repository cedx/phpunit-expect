<?php
/**
 * Implementation of the `PHPUnit\Expect\Assertion` class.
 */
namespace PHPUnit\Expect;
use PHPUnit\Framework\{Assert};

/**
 * Represents a test assertion.
 *
 * @property Assertion $a Chainable getter to improve the assertion readability.
 * @property Assertion $an Chainable getter to improve the assertion readability.
 * @property Assertion $and Chainable getter to improve the assertion readability.
 * @property Assertion $at Chainable getter to improve the assertion readability.
 * @property Assertion $be Chainable getter to improve the assertion readability.
 * @property Assertion $been Chainable getter to improve the assertion readability.
 * @property Assertion $directory Indicates that the assertion following in the chain targets a directory.
 * @property Assertion $empty Reports an error if the target is not empty.
 * @property Assertion $exist Reports an error if the file or directory specified by the target does not exist.
 * @property Assertion $false Reports an error if the target is `true`.
 * @property Assertion $file Indicates that the assertion following in the chain targets a file.
 * @property Assertion $has Chainable getter to improve the assertion readability.
 * @property Assertion $have Chainable getter to improve the assertion readability.
 * @property Assertion $infinite Reports an error if the target is not `INF`.
 * @property Assertion $is Chainable getter to improve the assertion readability.
 * @property Assertion $json Indicates that the assertion following in the chain targets JSON data.
 * @property Assertion $length Indicates that the assertion following in the chain targets a length.
 * @property Assertion $NaN Reports an error if the target is not `NAN`.
 * @property Assertion $not Negates any of assertions following in the chain.
 * @property Assertion $null Reports an error if the target is not `null`.
 * @property Assertion $of Chainable getter to improve the assertion readability.
 * @property Assertion $readable Reports an error if the file or directory specified by the target is not readable.
 * @property Assertion $same Chainable getter to improve the assertion readability.
 * @property Assertion $that Chainable getter to improve the assertion readability.
 * @property Assertion $throw Reports an error if the function target does not throw an exception.
 * @property Assertion $to Chainable getter to improve the assertion readability.
 * @property Assertion $true Reports an error if the target is `false`.
 * @property Assertion $which Chainable getter to improve the assertion readability.
 * @property Assertion $with Chainable getter to improve the assertion readability.
 * @property Assertion $writable Reports an error if the file or directory specified by the target is not writable.
 * @property Assertion $xml Indicates that the assertion following in the chain targets XML data.
 */
class Assertion {

  /**
   * @var bool Value indicating whether this assertion targets a directory.
   */
  private $isDirectory = false;

  /**
   * @var bool Value indicating whether this assertion targets a file.
   */
  private $isFile = false;

  /**
   * @var bool Value indicating whether this assertion targets JSON data.
   */
  private $isJSON = false;

  /**
   * @var bool Value indicating whether this assertion targets a length.
   */
  private $isLength = false;

  /**
   * @var bool Value indicating whether this assertion targets XML data.
   */
  private $isXML = false;

  /**
   * @var string Message identifying the error generated by the assertion when it fails.
   */
  private $message;

  /**
   * @var bool Value indicating whether to negate this assertion.
   */
  private $negate = false;

  /**
   * @var mixed The target of the assertion.
   */
  private $target;

  /**
   * Assertion constructor.
   * @param mixed $target The target of the assertion.
   * @param string $message Message identifying the error generated by the assertion when it fails.
   */
  public function __construct($target, string $message = '') {
    $this->target = $target;
    $this->message = $message;
  }

  /**
   * Invokes the instance method with the specified name.
   * @param string $name The name of the method to invoke.
   * @return mixed The return value of the invoked method.
   * @throws \InvalidArgumentException The specified method is not found.
   */
  public function __get(string $name) {
    static $reflection;
    if (!$reflection) $reflection = new \ReflectionClass(static::class);

    if ($reflection->hasMethod($name)) {
      $method = $reflection->getMethod($name);
      if ($method->isPublic() && !$method->getNumberOfRequiredParameters()) return $this->$name();
    }

    throw new \InvalidArgumentException("The specified method is not found: $name");
  }

  /**
   * Reports an error if the target is not of the specified type.
   * This method can also be used as language chain.
   * @param string $type The type to check. Specify an empty string to use as language chain.
   * @return Assertion This instance.
   */
  public function a(string $type = ''): self {
    if (mb_strlen($type)) {
      if ($this->negate) Assert::assertNotInternalType($type, $this->target, $this->message);
      else Assert::assertInternalType($type, $this->target, $this->message);
    }

    return $this;
  }

  /**
   * Reports an error if the target is not greater than the specified value.
   * @param int|float $value The value to compare.
   * @return Assertion This instance.
   */
  public function above($value): self {
    $target = $this->isLength ? $this->getLength($this->target) : $this->target;
    if ($this->negate) Assert::assertLessThanOrEqual($value, $target, $this->message);
    else Assert::assertGreaterThan($value, $target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not of the specified type.
   * This method can also be used as language chain.
   * @param string $type The type to check. Specify an empty string to use as language chain.
   * @return Assertion This instance.
   */
  public function an(string $type = ''): self {
    return $this->a($type);
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function and(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function at(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function be(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function been(): self {
    return $this;
  }

  /**
   * Reports an error if the target is not less than the specified value.
   * @param int|float $value The value to compare.
   * @return Assertion This instance.
   */
  public function below($value): self {
    $target = $this->isLength ? $this->getLength($this->target) : $this->target;
    if ($this->negate) Assert::assertGreaterThanOrEqual($value, $target, $this->message);
    else Assert::assertLessThan($value, $target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not equal to the specified value, within a given delta range.
   * @param int|float $value The value to compare.
   * @param float $delta The range for considering the target as equal.
   * @return Assertion This instance.
   */
  public function closeTo($value, float $delta): self {
    if ($this->negate) Assert::assertGreaterThan($delta, abs($this->target - $value), $this->message);
    else Assert::assertLessThanOrEqual($delta, abs($this->target - $value), $this->message);

    return $this;
  }

  /**
   * Reports an error if the target does not contain an element or a substring.
   * @param mixed $value The value to find.
   * @return Assertion This instance.
   */
  public function contain($value): self {
    if ($this->negate) Assert::assertNotContains($value, $this->target, $this->message);
    else Assert::assertContains($value, $this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target does not contain only variables of a given type.
   * @param string $type The type to check.
   * @return Assertion This instance.
   */
  public function containOnly(string $type): self {
    if ($this->negate) Assert::assertNotContainsOnly($type, $this->target, true, $this->message);
    else Assert::assertContainsOnly($type, $this->target, true, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target does not contain only instances of a giver class.
   * This assertion is not negatable.
   * @param string $className The name of the class to check.
   * @return Assertion This instance.
   */
  public function containOnlyInstancesOf(string $className): self {
    Assert::assertContainsOnlyInstancesOf($className, $this->target, $this->message);
    return $this;
  }

  /**
   * Indicates that the assertion following in the chain targets a directory.
   * @return Assertion This instance.
   */
  public function directory(): self {
    $this->isDirectory = true;
    return $this;
  }

  /**
   * Reports an error if the target is not empty.
   * For arrays and strings, it checks the length. For objects, it gets the count of accessible properties according to scope.
   * @return Assertion This instance.
   */
  public function empty(): self {
    if (is_object($this->target) && !($this->target instanceof \Countable)) {
      if ($this->negate) Assert::assertNotCount(0, get_object_vars($this->target), $this->message);
      else Assert::assertCount(0, get_object_vars($this->target), $this->message);
    }
    else if (is_string($this->target)) {
      if ($this->negate) Assert::assertNotEquals(0, mb_strlen($this->target), $this->message);
      else Assert::assertEquals(0, mb_strlen($this->target), $this->message);
    }
    else {
      if ($this->negate) Assert::assertNotEmpty($this->target, $this->message);
      else Assert::assertEmpty($this->target, $this->message);
    }

    return $this;
  }

  /**
   * Reports an error if the target does not end with the specified suffix.
   * @param string $value The suffix to check.
   * @return Assertion This instance.
   */
  public function endWith(string $value): self {
    if ($this->negate) Assert::assertStringEndsNotWith($value, $this->target, $this->message);
    else Assert::assertStringEndsWith($value, $this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target and the specified value are not equal.
   * @param mixed $value The value to compare.
   * @return Assertion This instance.
   */
  public function equal($value): self {
    if ($this->isFile) {
      if ($this->negate) Assert::assertFileNotEquals($value, $this->target, $this->message);
      else Assert::assertFileEquals($value, $this->target, $this->message);
    }
    else {
      if ($this->negate) Assert::assertNotEquals($value, $this->target, $this->message);
      else Assert::assertEquals($value, $this->target, $this->message);
    }

    return $this;
  }

  /**
   * Reports an error if the file or directory specified by the target does not exist.
   * @return Assertion This instance.
   * @throws \BadMethodCallException This assertion is not a file or directory one.
   */
  public function exist(): self {
    if ($this->isDirectory) {
      if ($this->negate) Assert::assertDirectoryNotExists($this->target, $this->message);
      else Assert::assertDirectoryExists($this->target, $this->message);
    }
    else if ($this->isFile) {
      if ($this->negate) Assert::assertFileNotExists($this->target, $this->message);
      else Assert::assertFileExists($this->target, $this->message);
    }
    else throw new \BadMethodCallException('This assertion is not a file or directory one.');

    return $this;
  }

  /**
   * Reports an error if the target is `true`.
   * @return Assertion This instance.
   */
  public function false(): self {
    if ($this->negate) Assert::assertNotFalse($this->target, $this->message);
    else Assert::assertFalse($this->target, $this->message);
    return $this;
  }

  /**
   * Indicates that the assertion following in the chain targets a file.
   * @return Assertion This instance.
   */
  public function file(): self {
    $this->isFile = true;
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function has(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function have(): self {
    return $this;
  }

  /**
   * Reports an error if the target and the specified variable do not have the same type and value.
   * @param mixed $value The variable to compare.
   * @return Assertion This instance.
   */
  public function identicalTo($value): self {
    if ($this->negate) Assert::assertNotSame($value, $this->target, $this->message);
    else Assert::assertSame($value, $this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not `INF`.
   * This assertion is not negatable.
   * @return Assertion This instance.
   */
  public function infinite(): self {
    Assert::assertInfinite($this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not an instance of the specified class.
   * @param string $className The name of the class to test.
   * @return Assertion This instance.
   */
  public function instanceOf(string $className): self {
    if ($this->negate) Assert::assertNotInstanceOf($className, $this->target, $this->message);
    else Assert::assertInstanceOf($className, $this->target, $this->message);
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function is(): self {
    return $this;
  }

  /**
   * Indicates that the assertion following in the chain targets JSON data.
   * @return Assertion This instance.
   */
  public function json(): self {
    $this->isJSON = true;
    return $this;
  }

  /**
   * Indicates that the assertion following in the chain targets a length.
   * @return Assertion This instance.
   */
  public function length(): self {
    $this->isLength = true;
    return $this;
  }

  /**
   * Reports an error if the length of the target is not the expected one.
   * @param int $expected The expected length.
   * @return Assertion This instance.
   */
  public function lengthOf(int $expected): self {
    if (is_string($this->target)) {
      if ($this->negate) Assert::assertNotEquals($expected, mb_strlen($this->target), $this->message);
      else Assert::assertEquals($expected, mb_strlen($this->target), $this->message);
    }
    else {
      if ($this->negate) Assert::assertNotCount($expected, $this->target, $this->message);
      else Assert::assertCount($expected, $this->target, $this->message);
    }

    return $this;
  }

  /**
   * Reports an error if the target is not greater than or equal to the specified value.
   * @param int|float $value The value to compare.
   * @return Assertion This instance.
   */
  public function least($value): self {
    $target = $this->isLength ? $this->getLength($this->target) : $this->target;
    if ($this->negate) Assert::assertLessThan($value, $target, $this->message);
    else Assert::assertGreaterThanOrEqual($value, $target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target does not match the specified regular expression.
   * @param string $pattern The regular expression to test.
   * @return Assertion This instance.
   */
  public function match(string $pattern): self {
    if ($this->negate) Assert::assertNotRegExp($pattern, $this->target, $this->message);
    else Assert::assertRegExp($pattern, $this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target does not match the specified format string.
   * @param string $format The format string to test.
   * @return Assertion This instance.
   */
  public function matchFormat(string $format): self {
    if ($this->negate) Assert::assertStringNotMatchesFormat($format, $this->target, $this->message);
    else Assert::assertStringMatchesFormat($format, $this->target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not less than or equal to the specified value.
   * @param int|float $value The value to compare.
   * @return Assertion This instance.
   */
  public function most($value): self {
    $target = $this->isLength ? $this->getLength($this->target) : $this->target;
    if ($this->negate) Assert::assertGreaterThan($value, $target, $this->message);
    else Assert::assertLessThanOrEqual($value, $target, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is not `NAN`.
   * This assertion is not negatable.
   * @return Assertion This instance.
   */
  public function NaN(): self {
    Assert::assertNan($this->target, $this->message);
    return $this;
  }

  /**
   * Negates any of assertions following in the chain.
   * @return Assertion This instance.
   */
  public function not(): self {
    $this->negate = true;
    return $this;
  }

  /**
   * Reports an error if the target is not `null`.
   * @return Assertion This instance.
   */
  public function null(): self {
    if ($this->negate) Assert::assertNotNull($this->target, $this->message);
    else Assert::assertNull($this->target, $this->message);
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function of(): self {
    return $this;
  }

  /**
   * Reports an error if the target is not contained in the specified list or string.
   * @param array|\Traversable $value The value provider.
   * @return Assertion This instance.
   */
  public function oneOf($value): self {
    if ($this->negate) Assert::assertNotContains($this->target, $value, $this->message);
    else Assert::assertContains($this->target, $value, $this->message);
    return $this;
  }

  /**
   * Reports an error if the file or directory specified by the target is not readable.
   * @return Assertion This instance.
   * @throws \BadMethodCallException This assertion is not a file or directory one.
   */
  public function readable(): self {
    if ($this->isDirectory) {
      if ($this->negate) Assert::assertDirectoryNotIsReadable($this->target, $this->message);
      else Assert::assertDirectoryIsReadable($this->target, $this->message);
    }
    else if ($this->isFile) {
      if ($this->negate) Assert::assertFileNotIsReadable($this->target, $this->message);
      else Assert::assertFileIsReadable($this->target, $this->message);
    }
    else throw new \BadMethodCallException('This assertion is not a file or directory one.');

    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function same(): self {
    return $this;
  }

  /**
   * Reports an error if the target does not pass a given truth test.
   * @param callable $predicate The predicate to invoke.
   * @return Assertion This instance.
   */
  public function satisfy(callable $predicate): self {
    $isSatisfactory = call_user_func($predicate, $this->target);
    if ($this->negate) Assert::assertFalse($isSatisfactory, $this->message);
    else Assert::assertTrue($isSatisfactory, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target does not start with the specified prefix.
   * @param string $value The prefix to check.
   * @return Assertion This instance.
   */
  public function startWith(string $value): self {
    if ($this->negate) Assert::assertStringStartsNotWith($value, $this->target, $this->message);
    else Assert::assertStringStartsWith($value, $this->target, $this->message);
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function that(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function to(): self {
    return $this;
  }

  /**
   * Reports an error if the function target does not throw a given exception.
   * @param string $className The class name of the exception.
   * @return Assertion This instance.
   * @throws \BadMethodCallException The function target is not callable.
   */
  public function throw(string $className = ''): self {
    if (!is_callable($this->target)) throw new \BadMethodCallException('The function target is not callable.');

    try {
      call_user_func($this->target);
      Assert::fail($this->message);
    }

    catch (\Throwable $e) {
      if (mb_strlen($className) && get_class($e) != $className) Assert::fail($this->message);
    }

    Assert::assertTrue(true, $this->message);
    return $this;
  }

  /**
   * Reports an error if the target is `false`.
   * @return Assertion This instance.
   */
  public function true(): self {
    if ($this->negate) Assert::assertNotTrue($this->target, $this->message);
    else Assert::assertTrue($this->target, $this->message);
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function which(): self {
    return $this;
  }

  /**
   * Chainable getter to improve the assertion readability.
   * @return Assertion This instance.
   */
  public function with(): self {
    return $this;
  }

  /**
   * Reports an error if the target is greater than or less than the specified bounds.
   * @param int|float $start The lowerbound inclusive.
   * @param int|float $finish The upperbound inclusive.
   * @return Assertion This instance.
   */
  public function within($start, $finish): self {
    $target = $this->isLength ? $this->getLength($this->target) : $this->target;

    if ($this->negate) {
      $constraint = Assert::logicalOr(Assert::greaterThan($finish), Assert::lessThan($start));
      Assert::assertThat($target, $constraint, $this->message);
    }
    else {
      Assert::assertGreaterThanOrEqual($start, $target, $this->message);
      Assert::assertLessThanOrEqual($finish, $target, $this->message);
    }

    return $this;
  }

  /**
   * Reports an error if the file or directory specified by the target is not writable.
   * @return Assertion This instance.
   * @throws \BadMethodCallException This assertion is not a file or directory one.
   */
  public function writable(): self {
    if ($this->isDirectory) {
      if ($this->negate) Assert::assertDirectoryNotIsWritable($this->target, $this->message);
      else Assert::assertDirectoryIsWritable($this->target, $this->message);
    }
    else if ($this->isFile) {
      if ($this->negate) Assert::assertFileNotIsWritable($this->target, $this->message);
      else Assert::assertFileIsWritable($this->target, $this->message);
    }
    else throw new \BadMethodCallException('This assertion is not a file or directory one.');

    return $this;
  }

  /**
   * Indicates that the assertion following in the chain targets XML data.
   * @return Assertion This instance.
   */
  public function xml(): self {
    $this->isXML = true;
    return $this;
  }

  /**
   * Returns the length of the specified value.
   * @param mixed $value An iterable value, like an array or a string.
   * @return int The length of the specified value.
   * @throws \InvalidArgumentException The specified value is not iterable.
   */
  private function getLength($value): int {
    if (is_array($value) || $value instanceof \Countable) return count($value);
    if (is_iterable($value)) return iterator_count($value);
    if (is_string($value)) return mb_strlen($value);
    throw new \InvalidArgumentException("The specified value is not iterable: $value");
  }
}
