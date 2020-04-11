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
    echo "<td>".$httpcode."</td>"; 
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


    ?>
<?php include('./head.php');?>


<div class="container-fluid">
  <div class="row">

<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 41%" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"></div>
</div>

</div>
</div>

<table class="table table-striped table-inverse table-responsive">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>URL</th>
      <th>ステータスコード</th>
      <th>正規化URL</th>
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
        stra($url);
        
        
      	//URLをパーツ枚に分割して、サブドメインまでで抜き出す。

        //URLをパースして分解する
        $parse_url=parse_url($url);

        //$parse_url["host"]にドメイン・サブドメインの部分がパースされて格納される
        $ar_host = array_reverse(explode('.',$parse_url["host"]));
        $ht = array_reverse(explode('.',$parse_url["scheme"]));
        $ar_host[1]=$ar_host[1].'.'.$ar_host[0];
        unset($ar_host[0]);

        //配列を結合する
        $url_merge = array_merge($ht, $ar_host);
        $hs="://";
        $hs2=".";
        $hs3="/";
        $pieces = [$url_merge[0],$hs, $url_merge[2],$hs2, $url_merge[1],$hs3];
        $url=implode($pieces);

        echo "<td>".$url."</td>";

        //ステータスコードを表示させる関数
        stra($url);

         echo "</tr>";
         if($i==50){
         break;
        }
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
