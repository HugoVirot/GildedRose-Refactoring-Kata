package com.gildedrose;

class GildedRose {
    Item[] items;

    public GildedRose(Item[] items) {
        this.items = items;
    }

    public void updateQuality() {
      //  for (int i = 0; i < items.length; i++) {   //= syntaxe améliorée ci-dessous
        for (Item item : items) {
            // si l'item est sulfuras, on n'exécute pas le code contenu dans la boucle for
            if (!item.name.equals("Sulfuras, Hand of Ragnaros")) {
                item.sellIn--;       // on baisse le sellIn de l'item (pareil pour tous sauf sulfuras)

                // cas des places de concert
                if (item.name.equals("Backstage passes to a TAFKAL80ETC concert")) {
                    if (item.sellIn > 10) {
                        item.quality++;
                    } else if (item.sellIn > 5) {
                        item.quality += 2;
                    } else if (item.sellIn >= 0) {
                        item.quality += 3;
                    } else {
                        item.quality = 0;
                    }

                    // tous items hors places de concert et sulfuras
                } else {

                    // modif qualité du brie
                    if (item.name.equals("Aged Brie")) {
                        if (item.sellIn >= 0) {
                            item.quality++;
                        } else {
                            item.quality += 2;
                        }
                    }

                    // modif qualité Conjured Mana Cake
                    else if (item.name.contains("Conjured")) {
                        if (item.sellIn >= 0) {
                            item.quality -= 2;
                        } else {
                            item.quality -= 4;
                        }
                    }

                    // modif qualité autres items
                    else {
                        if (item.sellIn < 0) {
                            item.quality -= 2;
                        } else {
                            item.quality--;
                        }
                    }

                    // ajustement à 0 si qualité négative
                    if (item.quality < 0) {
                        item.quality = 0;
                    }
                }

                // ajustement à 50 si qualité supérieure
                if (item.quality > 50) {
                    item.quality = 50;
                }
            }
        }
    }
}