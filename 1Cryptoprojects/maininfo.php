<?php
	include_once 'dbconnection.php';
	set_time_limit(0);

	$connection = new PDOconnectionMVC();
	$con = $connection -> connectionDB();

	function createCoin($symbol, $description, $tags)
	{
		$coin["symbol"] = $symbol;
		$coin["description"] = $description;
		$coin["tags"] = $tags;
		return $coin;
	}

	$array_crypto = [];
	//Diferencia en otro: Duda. $array_crypto = Array();
	array_push($array_crypto, createCoin("BTC","Peer-to-peer electronic payment system","Currency"));
	array_push($array_crypto, createCoin("ETH","Decentralized platform featuring smart contracts: applications that run exactly as programmed without any possibility of downtime, censorship, fraud or third party interference","Platform, Smart Contracts"));
	foreach ($array_crypto as $cObj)
	{
		$sql =  $con -> prepare ("update cryptoprojects set description = :description, tags = :tags where symbol = :symbol");
		$sql -> execute (array('description'=> $cObj["description"], 'symbol' => $cObj["symbol"], 'tags' => $cObj["tags"]));
	}
?>