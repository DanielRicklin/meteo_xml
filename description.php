<?php

$opts = array('http' => array('proxy'=> 'tcp://www-cache.iutnc.univ-lorraine.fr:3128', 'request_fulluri'=> true));
$context = stream_context_create($opts);

$descr = file_get_contents("http://www.velostanlib.fr/service/stationdetails/nancy/".$_GET['id'], NULL, $context);
$descr = simplexml_load_string($descr);

$data = ["Vélos disponibles"=>$descr->available,"Places Disponibles"=>$descr->free];

foreach($data as $key => $val){
    //echo 'hi'.$key . 'fgg' . $val;
    echo "$key: $val<br/>";
}