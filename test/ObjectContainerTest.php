<?php

namespace ProjxIO\Container;

use PHPUnit_Framework_TestCase;
use stdClass;

class ObjectContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    private static $container;

    /**
     * @var stdClass
     */
    private static $items;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass(); // TODO: Change the autogenerated stub

        self::$items  = (object)['a' => 'A'];
        self::$container = new ObjectContainer(self::$items);
    }

    public function testConstructor()
    {
        $this->assertEquals((array)self::$items, self::$container->items());
    }

    /**
     * @depends testConstructor
     * @return array
     */
    public function testPut()
    {
        $key = 'b';
        $value = 'B';

        self::$container->put($key, $value);

        $this->assertArrayHasKey($key, self::$container->items());
        $this->assertEquals($value, self::$container->items()[$key]);

        return [$key, $value];
    }

    /**
     * @depends testPut
     * @return array
     */
    public function testPutModifiedOriginal($params)
    {
        list($key, $value) = $params;

        $this->assertObjectHasAttribute($key, self::$items);
        $this->assertEquals($value, self::$items->{$key});

        return [$key, $value];
    }

    /**
     * @depends testConstructor
     * @return array
     */
    public function testDelete()
    {
        $key = 'a';
        $value = 'A';

        self::$container->delete($key);
        $this->assertArrayNotHasKey($key, self::$container->items());

        return [$key, $value];
    }

    /**
     * @depends testDelete
     * @return array
     */
    public function testDeleteModifiedOriginal($params)
    {
        list($key, $value) = $params;

        $this->assertObjectNotHasAttribute($key, self::$items);

        return $params;
    }
}
