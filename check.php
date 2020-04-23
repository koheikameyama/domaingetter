<?php

function stra($url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
  curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_TIMEOUT,2);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $output = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
  curl_close($ch);

  //echo 'HTTP code: ' . $httpcode;
    return $httpcode; 
}

//DBに接続する。
$USER= 'manabou_list';
$PW= 'amo22726';
$dnsinfo= "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";


try{
  $pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "SELECT * FROM TABLE1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(null);
	$res = "";
	$i=1;
	$dns_err=0;


    ?>
<?php include('./head.php');?>


<div class="container-fluid">
  <div class="row">

<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 41%" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"></div>
</div>

</div>
</div>

 <table id="fav-table" class="table table-bordered">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>URL</th>
      <th>ステータスコード</th>
      <th>ステータスコード</th>
      <th>ステータスコード</th>
    </tr>
    </thead>
    <tbody>

<?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr>";   
		echo "<td>".$i."</td>";
        $url = $row['COL10']."<br>";
        echo "<td>".$url."</td>";
        //ステータスコードを表示させる関数

        //stra($url);
		$url = $row['COL24']."<br>";
        echo "<td>".$url."</td>";

        //ステータスコードを表示させる関数
        $tom=stra($url);
		  echo "<td>".$tom."</td>";
// 現在の時刻
//echo date('h:i:s') . "\n";

// 10 秒間遅延させる
//sleep(1.5);

// 再開!
// echo date('h:i:s') . "\n";
		//ステータスコードが0の場合
		if(stra($url)==0){

		try{	
		
		//PREテーブルに各種データを移動
		$sql2 = "INSERT INTO PRE (id,url_r,move_date,service) VALUES (:id,:url_r,:move_date, :service)";
		$stmt2 = $pdo->prepare($sql2);
		$params2 = array(':id' => $dns_err,':url_r' => $row['COL24'],':move_date' => date("Y/m/d H:i:s"), ':service' => 'SAKURA_MAIN');
		//print_r($params2);echo "<br>"; 
		$stmt2->execute($params2);
	    $url=$row['COL24'];
		//移動なのでそのURLが含まれるデータを削除したい
		$sql3 = "DELETE FROM TABLE1 WHERE COL24 = '$url'";
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->execute(null);
		echo "<td>移動OK</td>";
	
		$dns_err++;
		

		
		
	}catch(Exception $e){
    echo $e->getMessage();
}
		  }//endif1

		 echo "</tr>"; 
		  
         if($i==9999999){
         break;
        }//endif2
	$i++;
      }//endwhile
  ?>
      
      <tr>
        <td scope="row"></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
</table>



</div>

</div>
</div>
<?php include("./footer.php");?>
<?php
}catch(Exception $e){
    echo $e->getMessage();
}

?>
