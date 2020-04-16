<?php declare(strict_types=1);

use PHPUnit\Framework\{TestCase};
use function PHPUnit\Expect\{expect, it};

/** A sample test class. */
class ExampleTest extends TestCase {

  /** A sample test method. */
  function testExample(): void {
    it('should test something', function() {
      expect(null)->to->be->null;
      expect(false)->to->not->be->true;

      expect(123)->to->equal(123);
      expect('hello')->to->not->equal('world');

      expect('123.456')->to->be->a('numeric');
      expect(function() {})->to->be->a('callable');
      expect(new stdClass)->to->be->an('object');

      expect([1, 2, 3])->to->have->lengthOf(3);
      expect('foobar')->to->have->lengthOf(6);
    });

    it('should test something else', function() {
      expect(10)->to->be->above(5);
      expect(5)->to->be->below(10);
      expect(10)->to->be->at->least(10);
      expect(5)->to->be->at->most(5);

      expect([1,2,3])->to->include(2);
      expect('foobar')->to->contain('foo');

      expect([])->to->be->empty;
      expect('')->to->be->empty;
      expect(new stdClass)->to->be->empty;

      expect('foo')->to->have->length->above(2);
      expect([1, 2, 3])->to->have->length->below(4);
      expect('foo')->to->have->length->of->at->least(3);
      expect([1, 2, 3])->to->have->length->of->at->most(3);
    });
  }
}
