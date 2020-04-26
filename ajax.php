<?php


//GET送信が行われているか判定
if ( isset( $_GET[ 'no' ] ) ) {
  //数値かどうか判定
  if ( ctype_digit( $_GET[ 'no' ] ) ) {
    $no = ( int )$_GET[ 'no' ];

    //データベース接続
    $USER = 'manabou_list';
    $PW = 'amo22726';
    $dnsinfo = "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";


    echo $no;


    //PREテーブルに各種データを移動
    $pdo = new PDO( $dnsinfo, $USER, $PW );
    $sql3 = "UPDATE PRE SET black = 1 WHERE id = '$no'";
    $stmt3 = $pdo->prepare( $sql3 );
    $stmt3->execute( null );


  }
}
?>