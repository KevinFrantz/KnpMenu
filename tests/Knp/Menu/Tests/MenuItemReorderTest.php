<?php

namespace Knp\Menu\Tests;

use Knp\Menu\MenuItem;

class MenuItemReorderTest extends \PHPUnit_Framework_TestCase
{
    public function testReordering()
    {
        $menu = new MenuItem('root');
        $menu->addChild('c1');
        $menu->addChild('c2');
        $menu->addChild('c3');
        $menu->addChild('c4');

        $menu['c3']->moveToFirstPosition();
        $arr = array_keys($menu->getChildren());
        $this->assertEquals(array('c3', 'c1', 'c2', 'c4'), $arr);

        $menu['c2']->moveToLastPosition();
        $arr = array_keys($menu->getChildren());
        $this->assertEquals(array('c3', 'c1', 'c4', 'c2'), $arr);

        $menu['c1']->moveToPosition(2);
        $arr = array_keys($menu->getChildren());
        $this->assertEquals(array('c3', 'c4', 'c1', 'c2'), $arr);

        $menu->reorderChildren(array('c4', 'c3', 'c2', 'c1'));
        $arr = array_keys($menu->getChildren());
        $this->assertEquals(array('c4', 'c3', 'c2', 'c1'), $arr);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testReorderingWithTooManyItemNames()
    {
        $menu = new MenuItem('root');
        $menu->addChild('c1');
        $menu->reorderChildren(array('c1', 'c3'));
    }
}