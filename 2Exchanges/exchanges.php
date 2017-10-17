<?php
	include_once 'dbconnection.php';
	set_time_limit(0);
	$connection = new PDOconnectionMVC();
	$con = $connection -> connectionDB();

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://api.coinmarketcap.com/v1/ticker/?limit=1'
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
		$sql =  $con -> prepare ("insert into cryptoprojects values (:caprank,:name,:symbol,:price_usd,:volume24h,:marketcap,:circulatingsupply,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null)");
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

	/*está desarrollado de manera correcta en onlyupdatesCP.php*/
	/*
	function createCoin($symbol, $description, $tags)
	{
		$coin["symbol"] = $symbol;
		$coin["description"] = $description;
		$coin["tags"] = $tags;
		return $coin;
	}

	$array_crypto = Array();
	array_push($array_crypto, createCoin("BTC","Peer-to-peer electronic payment system","Currency"));
	//array_push($array_crypto, createCoin("ETH","Decentralized platform featuring smart contracts: applications that run exactly as programmed without any possibility of downtime, censorship, fraud or third party interference","Platform, Smart Contracts"));
	foreach ($array_crypto as $cObj)
	{
		$sql =  $con -> prepare ("update cryptoprojects set description = :description, tags = :tags where symbol = :symbol");
		$sql -> execute (array('description'=> $cObj["description"], 'symbol' => $cObj["symbol"], 'tags' => $cObj["tags"]));
	}
	*/
	/*
	$homepage = file_get_contents('https://etherscan.io/token/tokenholderchart/0x006BeA43Baa3f7A6f765F14f10A1a1b08334EF45',null,null,200,1400);
	echo $homepage;
	*/
	//The Top 100 holders collectively own 81.31% (47,996,452.57 Tokens) Total Token Holders: 6596
	//<div Class='profile container' style='margin-top: 30px;'><div Class='tag-box tag-box-v3'><div Class='row content-boxes-v2'><center><p>&nbsp;<font color='maroon' size='3'><i Class='fa fa-lightbulb-o'></i></font> The Top 100 holders collectively own 81.31% (47,996,452.57 Tokens) of Stox</p><p>&nbsp;<font color='teal' size='3'><i Class='fa fa-lightbulb-o'></i></font> Tokens Total Supply: 59,031,802.36 Tokens &nbsp; | &nbsp; Total Token Holders: 6596</p></center></div></div></div>
	/*
	curl_setopt($curl,CURLOPT_URL,'https://etherscan.io/token/tokenholderchart/0x006BeA43Baa3f7A6f765F14f10A1a1b08334EF45');
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,2);
	$result = curl_exec($curl);
	//$subject="https://etherscan.io/token/tokenholderchart/0x006BeA43Baa3f7A6f765F14f10A1a1b08334EF45";
	$pattern='/The Top 100 holders collectively own<\/td><td.+?>(\d+)<\//';
	if(preg_match($pattern, $result, $hits)){
	print_r $hits;
		}
	*/

?>