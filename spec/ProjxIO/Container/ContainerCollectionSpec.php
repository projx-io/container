<?php

namespace spec\ProjxIO\Container;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ProjxIO\Container\ContainerCollection');
    }

    function it_should_add_an_item()
    {
        $this->contains('test')->shouldBe(false);
        $this->add('test');
        $this->contains('test')->shouldBe(true);
        $this->remove('test');
        $this->contains('test')->shouldBe(false);
    }

    function it_should_remove_an_item()
    {
        $this->add('test');
        $this->contains('test')->shouldBe(true);
        $this->remove('test');
        $this->contains('test')->shouldBe(false);
    }

    function it_should_map_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->map(function ($value) {
            return strtoupper($value);
        })->items()->shouldBe(['A', 'B', 'C', 'D']);
    }

    function it_should_filter_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->filter(function ($value) {
            return $value !== 'b';
        })->values()->items()->shouldBe(['a', 'c', 'd']);
    }

    function it_should_mapFilter_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->mapFilter(function ($value) {
            return strtoupper($value);
        }, function ($value) {
            return $value !== 'B';
        })->values()->items()->shouldBe(['a', 'c', 'd']);
    }

    function it_should_filterMap_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->filterMap(function ($value) {
            return $value !== 'b';
        }, function ($value) {
            return strtoupper($value);
        })->values()->items()->shouldBe(['A', 'b', 'C', 'D']);
    }

    function it_should_rename_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->rename(function ($value) {
            return strtoupper($value);
        })->items()->shouldBe(['A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd']);
    }

    function it_should_group_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->group(function ($value, $key, $index) {
            return $index % 2 ? 'odd' : 'even';
        })->map(function ($group) {
            return $group->items();
        })->items()->shouldBe(['even' => [0 => 'a', 2 => 'c'], 'odd' => [1 => 'b', 3 => 'd']]);
    }

    function it_should_sort_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->sort(function ($a, $b) {
            return strcmp($b, $a);
        })->items()->shouldBe([3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a']);
    }

    function it_should_mapSort_items()
    {
        $this->add('a');
        $this->add('b');
        $this->add('c');
        $this->add('d');

        $this->mapSort(function ($value) {
            return ord($value);
        }, function ($a, $b) {
            return $b - $a;
        })->items()->shouldBe([3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a']);
    }
}
