<?php declare(strict_types=1);
namespace PHPUnit\Expect;

/** Provides chainable methods to improve the readability of assertions. */
trait ChainableTrait {

  /**
   * Invokes the instance method with the specified name.
   * @param string $name The name of the method to invoke.
   * @return mixed The return value of the invoked method.
   * @throws \InvalidArgumentException The specified method is not found.
   */
  function __get(string $name) {
    static $reflection;
    if (!$reflection) $reflection = new \ReflectionClass(static::class);

    if ($reflection->hasMethod($name)) {
      $method = $reflection->getMethod($name);
      if ($method->isPublic() && !$method->getNumberOfRequiredParameters()) return $this->$name();
    }

    throw new \InvalidArgumentException("The specified method is not found: $name()");
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function and(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function at(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function be(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function been(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function but(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function does(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function has(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function have(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function is(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function of(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function same(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function still(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function that(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function to(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function which(): self {
    return $this;
  }

  /**
   * Chainable method to improve the readability of an assertion.
   * @return $this This instance.
   */
  function with(): self {
    return $this;
  }
}
