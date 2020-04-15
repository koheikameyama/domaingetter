<?php
//DBに接続する。
$USER= 'manabou_list';
$PW= 'amo22726';
$dnsinfo= "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";
$pdo = new PDO($dnsinfo,$USER,$PW);

$sql = "DELETE FROM PRE WHERE No NOT IN (
    SELECT move_date FROM (
        SELECT MAX(move_date) move_date FROM PRE GROUP BY url_r
    ) tmp
);";
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
