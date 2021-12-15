<?php

use Services\Akakce;
use Services\Google;

Header('Content-type: text/xml');

include('Contract/ICommerce.php');
include('Services/Akakce.php');
include('Services/Google.php');

switch ($slug) {
    case "akakce":
        $x = new Akakce();
        $x = $x->build();
        echo $x;
        break;
    case "google":
        $x = new Google();
        $x = $x->build();
        echo $x;
        break;
    default:
        $xml = new SimpleXMLElement('<xml />');
        $track = $xml->addChild('errors');
        $track->addChild('error', '<![CDATA[ "Bulunamadı" ]]>');
        echo $xml->asXML();
        break;
}