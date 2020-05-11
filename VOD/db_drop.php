<?php
//DBに接続する。
$USER= 'manabou_list';
$PW= 'amo22726';
$dnsinfo= "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";
$pdo = new PDO($dnsinfo,$USER,$PW);

$sql = "TRUNCATE TABLE1";
$result = $pdo -> query($sql);
$sql = "TRUNCATE PRE";
$result = $pdo -> query($sql);

//クエリー失敗
if(!$result) {
	echo $pdo->error;
	exit();
}//連想配列で取得


//結果セットを解放
//$result->free();
 
// データベース切断
//$pdo->close();
?>
