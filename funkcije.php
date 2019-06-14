<?php

function ime($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		$attr = $rezidencija->getAttribute("ime");
		if(stripos(mb_strtoupper($attr), mb_strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function grad($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		#print_r($request);
		$attr = $rezidencija->getElementsByTagName('lokacija')->item(0)->getAttribute("grad");
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function adresa($rezidencije, $request, $name) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		#print_r($request);
		$attr = $rezidencija->getElementsByTagName('lokacija')->item(0)->getElementsByTagName('adresa')->item(0)->getAttribute($name);
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function narucitelj($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		#print_r($request);
		$attr = $rezidencija->getElementsByTagName('izgradnja')->item(0)->getAttribute('narucitelj');
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function arhitekt($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		#print_r($request);
		$attr = $rezidencija->getElementsByTagName('izgradnja')->item(0)->getElementsByTagName('arhitekt')->item(0)->nodeValue;
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function godina($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		#print_r($request);
		$attr = $rezidencija->getElementsByTagName('izgradnja')->item(0)->getElementsByTagName('razdoblje')->item(0)->getAttribute('godina');
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function predsjednik($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		$attr = $rezidencija->getAttribute("trenutni_predsjednik");
		if(stripos(strtoupper($attr), strtoupper($request))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function drzava($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		foreach($request as $drzava){
			$attr = $rezidencija->getElementsByTagName( 'lokacija' )->item(0)->getElementsByTagName('drzava')->item(0)->getElementsByTagName("*")->item(0)->nodeName;
			
			if(stripos(strtoupper($attr), strtoupper($drzava))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
			}
		}

	}
	return $filtrirane_rezidencije;
}

function velicina($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		foreach($request as $vel){
			$attr = $rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getElementsByTagName('velicina')->item(0)->getElementsByTagName("*")->item(0)->nodeName;
			
			if(stripos(strtoupper($attr), strtoupper($vel))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
			}
		}

	}
	return $filtrirane_rezidencije;
}

function brkat($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		#$attr = $rezidencija->attributes->getNamedItem("ime")->value;
		$attr = $rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getAttribute('broj_katova');
		$req = current($request);
		if(stripos(strtoupper($attr), strtoupper($req))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
		}
	}
	return $filtrirane_rezidencije;
}

function stil($rezidencije, $request) {
	$filtrirane_rezidencije = array();
	foreach($rezidencije as $rezidencija){
		foreach($request as $stil){
			$attr = $rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getElementsByTagName('razdoblje')->item(0)->getElementsByTagName("stil_gradnje")->item(0)->getElementsByTagName("*")->item(0)->nodeName;
			
			if(stripos(strtoupper($attr), strtoupper($stil))!==false){
			array_push($filtrirane_rezidencije, $rezidencija);
			}
		}

	}
	return $filtrirane_rezidencije;
}

function parsiraj($lok){

	

    $adresa = "";
    $lok = str_split($lok);
    foreach($lok as $char){
    	#echo $char;
    	if (ctype_alpha ($char) || $char==',' || $char==' ' || is_numeric ($char))
    		$adresa=$adresa.$char;
    }

    return $adresa;
}

?>