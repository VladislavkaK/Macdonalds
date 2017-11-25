<?php

use PHPUnit\Framework\TestCase;
use App\ArrayAndList\LinkedList;
use App\ArrayAndList\Node;

class LinkedListTest extends TestCase {
    private $list = null;
    public function setUp() {
        $this->list = new LinkedList();
    }

    public function tearDown() {
        $this->list = null;
    }

    public function testEmptyListSize() {
        $count = $this->list->size();

        $this->assertEquals(0, $count);
    }

    public function testGetElementOnEmptyList()
    {
        // TODO: catch right exception type
        $this->expectException('Exception');

        $this->list->get(0);
    }

    public function testGetElementWithNegativeIndex() {
        // TODO: catch right exception type
        $this->expectException('Exception');

        $this->list->get(-1);
    }

    public function testAddOneElement() {
        $this->list->add(null);

        $count = $this->list->size();
        $result = $this->list->get(0);

        $this->assertEquals(1, $count);
        $this->assertEquals(null, $result);

    }

    public function testMultipleElement() {
        $this->list->add(null); // dummy
        $this->list->add(null); // dummy
        $this->list->add('test');

        $count = $this->list->size();
        $result = $this->list->get(2);

        $this->assertEquals(3, $count);
        $this->assertEquals('test', $result);
    }

    public function testInsertElementWithGreaterIndexThanSize()
    {
        // TODO: catch right exception type
        $this->expectException('Exception');

        $this->list->insert(0, null);
    }

    public function testInsertElementWithNegativeIndex() {
        // TODO: catch right exception type
        $this->expectException('Exception');

        $this->list->insert(-1, null);
    }

    public function testInsertOneElement()
    {
        $this->list->add(null);
        $this->list->insert(0, 'test');

        $count = $this->list->size();
        $inserted = $this->list->get(0);
        $moved = $this->list->get(1);

        $this->assertEquals(2, $count);
        $this->assertEquals('test', $inserted);
        $this->assertEquals(null, $moved);

    }

    public function testSetNode()
    {
        $node = new Node(null);
        $node->setValue(1);

        $this->assertEquals(1 ,$node->getValue());
    }

    public function testInsertMultipleElements()
    {
        $this->list->add(null);
        $this->list->insert(0, 'first');
        $this->list->insert(1, 'second');
        $this->list->insert(2, 'third');

        $count = $this->list->size();
        $first = $this->list->get(0);
        $second = $this->list->get(1);
        $third = $this->list->get(2);
        $last = $this->list->get(3);


        $this->assertEquals(4, $count);
        $this->assertEquals('first', $first);
        $this->assertEquals('second', $second);
        $this->assertEquals('third', $third);
        $this->assertEquals(null, $last);

    }

    public function testRemoveOneElement()
    {
        $this->list->add(null);
        $this->list->remove(0);

        $count = $this->list->size();

        $this->assertEquals(0, $count);

    }

    public function testRemoveMultipleElements()
    {
        $this->list->add('first');
        $this->list->add(null);
        $this->list->add('last');

        $this->list->remove(1);

        $count = $this->list->size();
        $first = $this->list->get(0);
        $last = $this->list->get($this->list->size() - 1);

        $this->assertEquals(2, $count);
        $this->assertEquals('first', $first);
        $this->assertEquals('last', $last);

    }

}
