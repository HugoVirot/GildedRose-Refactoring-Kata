<?php

namespace App;

require '../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testSellInDecreasesByOne()
    {
        $items = [new Item("foo", 1, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->sell_in);
    }

    public function testQualityDecreasesByOne()
    {
        $items = [new Item("foo", 0, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testQualityNeverNegative()
    {
        $items = [new Item("foo", 0, 1)];
        $gildedRose = new GildedRose($items);
        $days = 5;
        for ($days; $days > 0; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testQualityNeverOverFifty()
    {
        $items = [new Item("foo", 0, 60)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testSulfurasSellInNeverChanges()
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->sell_in);
    }

    public function testSulfurasQualityNeverChanges()
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
    }

    public function testAgedBrieQualityIncreasesByOne()
    {
        $items = [new Item("Aged Brie", 1, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->quality);
    }

    public function testAgedBrieQualityIncreasesByTwoIfSellInIsNegative()
    {
        $items = [new Item("Aged Brie", 0, 0)];
        $gildedRose = new GildedRose($items);
        $days = 5;
        for ($days; $days > 0; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(10, $items[0]->quality);
    }

    public function testBackstagePassesQualityIncreasesByTwo()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 10, 0)];
        $gildedRose = new GildedRose($items);
        $days = 10;
        for ($days; $days > 5; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(10, $items[0]->quality);
    }

    public function testBackstagePassesQualityIncreasesByThree()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 0)];
        $gildedRose = new GildedRose($items);
        $days = 5;
        for ($days; $days > 0; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(15, $items[0]->quality);
    }

    public function testBackstagePassesQualityChangesToZero()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testConjuredDecreasesByTwo()
    {
        $items = [new Item("Conjured Mana Cake", 5, 10)];
        $gildedRose = new GildedRose($items);
        $days = 5;
        for ($days; $days > 0; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testConjuredDecreasesByFour()
    {
        $items = [new Item("Conjured Mana Cake", 0, 20)];
        $gildedRose = new GildedRose($items);
        $days = 5;
        for ($days; $days > 0; $days--) {
            $gildedRose->updateQuality();
        }
        $this->assertEquals(0, $items[0]->quality);
    }


}
