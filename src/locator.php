<?php

use Services\Akakce;
use Services\Google;

Header('Content-type: text/xml');

include('Contract/ICommerce.php');
include('Services/Akakce.php');
include('Services/Google.php');

if ($slug == 'akakce') {
    $x = new Akakce();
    $x = $x->build();
    echo $x;
}else if($slug == 'google')
{
    $x = new Google();
    $x = $x->build();
    echo $x;
}