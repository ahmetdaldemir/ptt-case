<?php namespace Services;

use Contract\ICommerce;
use SimpleXMLElement;


class Akakce implements ICommerce
{

    protected array $products;

    public function __construct()
    {
        if(!class_exists('SimpleXMLElement')) die("SimpleXMLElement Not Found");
        $newProducts = json_decode(file_get_contents('Storage/products.json'),TRUE);
        $this->products = $this->unsetEmptyItem($newProducts);
    }

    public function build(): string
    {
        $xml = new SimpleXMLElement('<xml />');
        foreach ($this->products as $product) {
            $track = $xml->addChild('product');
            $track->addChild('name', $product['name'] ?? NULL);
            $track->addChild('sku', $product['id'] ?? NULL);
            $track->addChild('price', $product['price'] ?? NULL);
            $track->addChild('productCategory', $product['category'] ?? NULL);
        }
        return $xml->asXML();
    }

    public function unsetEmptyItem(array $newProducts)
    {
        return array_filter($newProducts);
    }
}