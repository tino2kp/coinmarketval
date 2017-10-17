<?php
	//1Falta ver por qué no se ejecuta correctamente con los 198 símbolos
	//2Falta hacer iteración con los símbolos y que matcheen en $sql where realsymbol:arreglar liasons
	//3Falta handle errors
	include_once 'dbconnection.php';
	set_time_limit(0);

	$connection = new PDOconnectionMVC();
	$con = $connection -> connectionDB();
	/*
	Retrieve all stored coins from DB
	Note: I don't know the names of the tables and columns, so change this part :)*/
	/*
	$sql = $con -> prepare ("select symbol from table");
	$sql -> execute();
	$coinTocheck = $sql->fetchAll();*/
	/* CHAINZCRYPTOID 198 */
	//testgithub
	$chainzymbol = array('ltc','dash');
	// $chainzymbol = array('1337','2give','42','8bit','ac','adc','anc','arco','arg','atms','atom','b3','bash','bay','bcc','bela','bigup','bitb','blitz','blk','block','boli','brit','bro','bsd','bta','btdx','btm','btx','bucks','bxt','byc','c2','cach','cann','carbon','cbx','ccn','chao','club','cnc','cno','cpc','crea','crw','crypt','cure','dash','dgb','dgc','dime','dmd','dnr','dollar','dope','dot','drs','dvc','eac','ecc','ecn','efl','emc2','emd','enrg','ent','eqt','erc','ery','euc','flax','funk','gam','gap','gcr','geo','glc','gld','gre','grs','grt','gun','hbn','hxx','i0c','icn','imx','infx','insn','ioc','ion','ixc','j','jwl','knc','kobo','kush','lana','lir','ltc','mac','may','meow','mnd','moon','mscn','mst','mue','nav','neos','netko','neva','nobl','note','nro','off','ok','omc','opal','pak','part','pho','piggy','pink','pivx','pnd','post','pot','ppc','pr','psb','ptc','pura','put','px','pxi','qrk','qtl','rads','rby','ric','rsgp','sdc','sh','sha','slr','smly','snrg','spr','sprts','strat','stv','super','swift','swing','sync','sys','taj','talk','tes','tor','troll','trump','trust','tx','ufo','uni','uno','usc','vash','via','visio','vrc','vrm','vuc','wbb','wbc','wex','worm','wyv','xc','xjo','xlr','xmg','xmy','xp','xpy','xspec','xst','xvp','xzc','zeit','zet','zoi');
	$realsymbol = array('1337','2GIVE','42','8BIT','AC','ADC','ANC','ARCO','ARG','ATMS','ATOM','B3','BASH','BAY','BCC','BELA','BIGUP','BITB','BLITZ','BLK','BLOCK','BOLI','BRIT','BRO','BSD','BTA','BTDX','BTM','BTX','BUCKS','BXT','BYC','C2','CACH','CANN','CARBON','CBX','CCN','CHAO','CLUB','CNC','CNO','CPC','CREA','CRW','CRYPT','CURE','DASH','DGB','DGC','DIME','DMD','DNR','DOLLAR','DOPE','DOT','DRS','DVC','EAC','ECC','ECN','EFL','EMC2','EMD','ENRG','ENT','EQT','ERC','ERY','EUC','FLAX','FUNK','GAM','GAP','GCR','GEO','GLC','GLD','GRE','GRS','GRT','GUN','HBN','HXX','I0C','ICN','IMX','INFX','INSN','IOC','ION','IXC','J','JWL','KNC','KOBO','KUSH','LANA','LIR','LTC','MAC','MAY','MEOW','MND','MOON','MSCN','MST','MUE','NAV','NEOS','NETKO','NEVA','NOBL','NOTE','NRO','OFF','OK','OMC','OPAL','PAK','PART','PHO','PIGGY','PINK','PIVX','PND','POST','POT','PPC','PR','PSB','PTC','PURA','PUT','PX','PXI','QRK','QTL','RADS','RBY','RIC','RSGP','SDC','SH','SHA','SLR','SMLY','SNRG','SPR','SPRTS','STRAT','STV','SUPER','SWIFT','SWING','SYNC','SYS','TAJ','TALK','TES','TOR','TROLL','TRUMP','TRUST','TX','UFO','UNI','UNO','USC','VASH','VIA','VISIO','VRC','VRM','VUC','WBB','WBC','WEX','WORM','WYV','XC','XJO','XLR','XMG','XMY','XP','XPY','XSPEC','XST','XVP','XZC','ZEIT','ZET','ZOI');
	//Exceptions
	/*
	$chainzymbol = fuel where realsymbol = fc2;
	$chainzymbol = karm where realsymbol = karma;
	$chainzymbol = mojo3 where realsymbol = mojo;
	$chainzymbol = octo where realsymbol = 888;
	*/
	//For each record(symbol) get wealth distribution
	foreach ($chainzymbol as $coinsymbol)
	{
		//Total addresses
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://chainz.cryptoid.info/'.$coinsymbol.'/api.dws?q=addresses'
		));
		$result = curl_exec($curl);
		$decode_json = json_decode($result);
		$addresses = $decode_json->nonzero;
		echo $addresses;
		/*2
		$sql = $con -> prepare ("update cryptoprojects set lockedsupply = :lockedsupply where symbol = :symbol ");
		$sql -> execute (array('lockedsupply' => $lockedsupply, 'symbol' => $coinsymbol));
		*/
	}
?>