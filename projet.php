<?php

//LE PROXY
$opts = array('http' => array('proxy'=> 'tcp://www-cache.iutnc.univ-lorraine.fr:3128', 'request_fulluri'=> true));
$context = stream_context_create($opts);



//POUR LES STATIONS DE VELO
$station = file_get_contents("http://www.velostanlib.fr/service/carto", NULL, $context); 

$dataStation = simplexml_load_string($station);
//var_dump($dataStation);


//INFO STATION
//$descrIn = $dataStation->addChild('descriptions');
/*for($i=1;$i<=27;$i++){
	$descr = file_get_contents("http://www.velostanlib.fr/service/stationdetails/nancy/".$i, NULL, $context);
	$descr = simplexml_load_string($descr);
	$dataStation->addChild('stations',$descr->asXML());
}*/

//var_dump($dataStation);

//RECUPERATION DES DONNEES GPS
$str = file_get_contents("http://ip-api.com/xml", NULL, $context); 
$xml = simplexml_load_string($str, 'SimpleXMLElement',LIBXML_NOCDATA);



//POUR LA METEO
$str = file_get_contents("http://www.infoclimat.fr/public-api/gfs/xml?_ll=".$xml->lat.",".$xml->lon."&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2", NULL, $context);


$XML = simplexml_load_string($str);
//$gps = ["$xml->lat", "$xml->lon"];
//$gps = [(string) $xml->lat, (string) $xml->lon];

$xsl = new DOMDocument;
$xsl->load('meteo.xsl');

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

$meteo = $proc->transformToXml($XML);



//POUR LA CARTE
$xsl = new DOMDocument;
$xsl->load('carte.xsl');

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

$carte = $proc->transformToXml($XML);

//POUR LES STATIONS
$xsl = new DOMDocument;
$xsl->load('station.xsl');

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);


$stationxsl = $proc->transformToXml($dataStation);

/*for($i=1;$i<=27;$i++){
	${'r'.$i} = $proc->transformToXml(${'t'.$i});
}*/


echo <<<END
<!DOCTYPE html>
	<html>
		<head>
			<title>CARTE</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

			<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
				integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
				crossorigin=""></script>
						
			<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
			<style>
				.hidden{
					display:none;
				}
			</style>
	   	</head>
	   	<body>
END;
	$lat = $xml->lat;
	$lon = $xml->lon;
    echo"<div class='hidden' id='lat'>$lat</div>";
    echo"<div class='hidden' id='lon'>$lon</div>";
    //echo $xslt->transformToXML($xml);
    //echo $xslt->transformToXML($dataStation);
echo <<<END
	   		$carte
			$meteo
			$stationxsl
	   	</body>
   	</html>
END;




