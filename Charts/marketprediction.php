<?php 
 	//http://localhost/Coinmarketval/marketprediction.php
 	include_once 'dbconnection.php';
 	set_time_limit(0);
 	
	$connection = new PDOconnectionMVC();
	$con = $connection -> connectionDB(); 

	$curl = curl_init();
	curl_setopt_array($curl, array(
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'https://api.coinmarketcap.com/v1/ticker/?limit=200'
	));
	$result = curl_exec($curl);
	 
	$decode_json = json_decode($result);
	foreach ($decode_json as $cObj) 
	{
		$rank = $cObj -> rank;
	    $name = $cObj -> name;
	    $price_usd = $cObj -> price_usd;
	    $volume24h = $cObj -> {'24h_volume_usd'};
	    $market_cap_usd = $cObj -> market_cap_usd;
	    $sql =  $con -> prepare ("insert into marketprediction values (:caprank,:name,:price_usd,:volume24h,:marketcap,null,null,null,null,null,null,now())");
	    $sql -> execute (array('caprank'=> $rank,  'name' => $name, 'price_usd' => $price_usd, 'marketcap' => $market_cap_usd, 'volume24h' => $volume24h));
 	}
	
 	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'https://api.coinmarketcap.com/v1/global/'
	));
	$result = curl_exec($curl);
	curl_close($curl);

	$decode_json = json_decode($result);
		$total_market_cap_usd = $decode_json -> total_market_cap_usd;
		$total_24h_volume_usd = $decode_json -> total_24h_volume_usd;
		$sql =  $con -> prepare ("update marketprediction set pglobal = :pglobal, globalvolume24h = :globalvolume24h");
	 	$sql -> execute (array('pglobal'=> $total_market_cap_usd, 'globalvolume24h' => $total_24h_volume_usd));
/*
cada 10 segs
field porcentajehealth = division de $marketcap entre $volume24h = crear variable $porcentajehealth. guardar en db.
field cambiohealth = contrastar valor actual $porcentajehealth con valor pasado $porcentajehealth. guardar en db.
*derivar para averiguar tasa de cambio
field porcentajeprice = division de $price_usd actual con $price_usd pasado 
*derivar para averiguar tasa de cambio

field porcentajeglobalcoinmarketcap = guardar valor total de coinmarketcap creando variable porcentajeglobalcoinmarketcap
field cambioglobalcoinmarketcap = guardar division de $cambioglobalcoinmarketcap actual con $cambioglobalcoinmarketcap pasado 
*derivar para averiguar tasa de cambio

si globalcoinmarketcap sub
hacer chart con los valores de variable porcentaje. y marcar si el precio global de coinmarketcap sube o baja.
guardar cambio de division: dividir

cada 1 min
cada 1 hora
*/
?>

