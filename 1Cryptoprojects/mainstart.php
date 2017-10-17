<?php
	include_once 'dbconnection.php';
	set_time_limit(0);

	$connection = new PDOconnectionMVC();
	$con = $connection -> connectionDB();

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://api.coinmarketcap.com/v1/ticker/?limit=400'
	));
	$result = curl_exec($curl);

	$decode_json = json_decode($result);
	foreach ($decode_json as $cObj)
	{
		$rank = $cObj -> rank;
		$name = $cObj -> name;
		$symbol = $cObj -> symbol;
		$price_usd = $cObj -> price_usd;
		$volume24h = $cObj -> {'24h_volume_usd'};
		$market_cap_usd = $cObj -> market_cap_usd;
		$available_supply = $cObj -> available_supply;
		$sql =  $con -> prepare ("insert into cryptoprojects values (:caprank,:name,:symbol,:price_usd,:volume24h,:marketcap,:circulatingsupply,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null)");
		$sql -> execute (array('caprank'=> $rank,  'name' => $name, 'symbol' => $symbol, 'price_usd' => $price_usd, 'marketcap' => $market_cap_usd, 'circulatingsupply' => $available_supply, 'volume24h' => $volume24h));
	}
	/*se agregaron manualmente :v*/
	/*
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://www.cryptocompare.com/api/data/coinlist/'
		));
	$result = curl_exec($curl);

	$decode_json = json_decode($result);
	foreach ($decode_json->Data as $cObj)
	{
		$algorithm = $cObj -> Algorithm;
		$prooftype = $cObj -> ProofType;
		$symbol = $cObj-> Name;
		$sql =  $con -> prepare ("update cryptoprojects set algorithm = :algorithm, network = :prooftype where symbol = :symbol");
		$sql -> execute (array('algorithm'=> $algorithm, 'prooftype' => $prooftype, 'symbol' => $symbol));
	}
	*/

	/*se agregaron manualmente tambien :,V!*/
	/*
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://www.cryptopia.co.nz/api/GetCurrencies'
		));
	$result = curl_exec($curl);
	curl_close($curl);

	$decode_json = json_decode($result);
	foreach ($decode_json->Data as $cObj)
	{
		$algorithm = $cObj -> Algorithm;
		$symbol = $cObj -> Symbol;
		$sql =  $con -> prepare ("update cryptoprojects set algorithm = :algorithm where symbol = :symbol");
		$sql -> execute (array('algorithm'=> $algorithm, 'symbol' => $symbol));
	}
	*/
?>