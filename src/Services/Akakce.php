<?php namespace Services;

use Contract\ICommerce;
use SimpleXMLElement;


class Akakce implements ICommerce
{

    protected array $products;

    public function __construct()
    {
        $this->products = json_decode(file_get_contents('Storage/products.json'));
    }

    public function build(): string
    {
        $xml = new SimpleXMLElement('<xml />');
        foreach ($this->products as $product) {
            $track = $xml->addChild('product');
            $track->addChild('name', $product->name);
            $track->addChild('sku', $product->id);
            $track->addChild('price', $product->price);
            $track->addChild('productCategory', $product->category);
        }
        Header('Content-type: text/xml');
        return $xml->asXML();
    }
}