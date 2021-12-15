<?php

namespace Services;

use Contract\ICommerce;
use SimpleXMLElement;


class Google implements ICommerce
{


    protected array $products;

    public function __construct()
    {
        $newProducts = json_decode(file_get_contents('Storage/products.json'),TRUE);
        $this->products = $this->unsetEmptyItem($newProducts);
    }


    public function build():string
    {
        $xml = new SimpleXMLElement('<rss />');
        foreach ($this->products as $product) {
            $track = $xml->addChild('channel');
            $track->addChild('g:title', $product['name'] ?? NULL);
            $track->addChild('g:id', $product['id'] ?? NULL);
            $track->addChild('g:price', $product['price'] ?? NULL);
            $track->addChild('g:google_product_category', $product['category'] ?? NULL);
        }
        return $xml->asXML();
    }

    public function unsetEmptyItem(array $newProducts)
    {
        return array_filter($newProducts);
    }

}