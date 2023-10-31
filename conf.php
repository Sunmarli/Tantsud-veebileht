<?php

$serverinimi="d119764.mysql.zonevs.eu";
$kasutajanimi="d119764_uusteste";
$parool="Mnenavsjopofig1994";
$andmebaas="d119764_esimene";

$yhendus=new mysqli($serverinimi,$kasutajanimi,$parool, $andmebaas);
$yhendus->set_charset('UTF8');

