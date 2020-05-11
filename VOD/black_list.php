<?php

function db_connect(){
	//データベース接続
$USER= 'manabou_list';
$PW= 'amo22726';
$dnsinfo= "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";

 
	$pdo = new PDO($dnsinfo,$USER,$PW);
	
	try{
		
		
	echo $url;
  	$pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "SELECT * FROM TABLE1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(null);
	$res = "";
	$i=1;
	$dns_err=0;
		
		
	}
	
	
	
 
	if ($pdo->connect_error){
		echo $pdo->connect_error;
		exit();
	}else{
		$pdo->set_charset("utf-8");
	}
	return $pdo;
}

?>