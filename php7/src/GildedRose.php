<?php

namespace App;

require '../vendor/autoload.php';

final class GildedRose
{

    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {

            if ($item->name == "Sulfuras, Hand of Ragnaros") {
                echo "L'item est le Sulfuras : il ne s'altère jamais";
            } else if ($item->name == "Aged Brie") {
                $item->sell_in--;
                $item->quality++;
                if ($item->sell_in < 0) {
                    $item->quality++;
                }
            } else if ($item->name == "Backstage passes to a TAFKAL80ETC concert") {
                $item->sell_in--;
                $item->quality++;
                if ($item->sell_in < 11) {
                    $item->quality++;
                }
                if ($item->sell_in < 6) {
                    $item->quality++;
                }
                if ($item->sell_in < 0) {
                    $item->quality = 0;
                }
            } else if (substr($item->name, 0, 8) == "Conjured") {
                echo "item Conjured";
                $item->sell_in--;
                $item->quality -= 2;
                if ($item->sell_in < 0) {
                    $item->quality -= 2;
                }
            } else {
                $item->sell_in--;
                $item->quality--;
            }
            $this->checkQuality($item);
        }
    }

    public function checkQuality($item)
    {
        if ($item->quality < 0) {
            $item->quality = 0;
        }
        if ($item->name != "Sulfuras, Hand of Ragnaros" && $item->quality > 50) {
            $item->quality = 50;
        }
        return $item;
    }
}

