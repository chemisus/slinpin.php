<?php

namespace Slinpin;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-11-30 at 20:40:42.
 */
class ContainerTest extends \PHPUnit_Framework_TestCase {
    public static function dataProvider() {
        return array(
            array(array('a'=>'A'), 'a', 'A'),
            array(array('b'=>'B'), 'b', 'B'),
            array(array('c'=>'C'), 'c', 'C'),
            array(array('d'=>'D'), 'd', 'D'),
            array(array('e'=>'E'), 'e', 'E'),
        );
    }
    
    /**
     * @covers Slinpin\Container::get
     * @dataProvider dataProvider
     */
    public function testGet($values, $key, $value) {
        $expect = $value;
        
        $container = new Container($values);
        
        $actual = $container->get($key);
        
        $this->assertEquals($expect, $actual);
    }

    /**
     * @covers Slinpin\Container::set
     * @dataProvider dataProvider
     */
    public function testSet($values, $key, $value) {
        $expect = $value;
        
        $container = new Container();
        
        $container->set($key, $value);
        
        $actual = $container->get($key);
        
        $this->assertEquals($expect, $actual);
    }

    /**
     * @covers Slinpin\Container::has
     * @dataProvider dataProvider
     */
    public function testHas($values, $key, $value) {
        $container = new Container($values);
        
        $actual = $container->has($key);
        
        $this->assertTrue($actual);
    }

}
