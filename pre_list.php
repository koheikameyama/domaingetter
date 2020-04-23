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
	$sql = "SELECT * FROM PRE";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(null);
	$res = "";
	$i=1;

  	$pdo2 = new PDO($dnsinfo,$USER,$PW);
	$sql2 = "SELECT * FROM TABLE1";
	$stmt2 = $pdo->prepare($sql2);
	$stmt2->execute(null);
	$res = "";
	$i=1;

    ?>
<?php include('./head.php');?>



<div class="container-fluid mb-2">
  
  <div class="row">
	    <div class="col-4"></div>
	    <div class="col-4"></div>
	    <div class="col-4"><form type="button" class="btn btn-info"　method="post" action="db_dpp.php">データベース削除<input type="submit" name="s" value="実行"></form></div>
</div>
</div>
<div class="card-body">
  <div id="response0"></div>

 <table id="fav-table" class="table table-bordered sort-table">
  <thead class="thead-inverse">
	  <tr>
		  <th>No</th>
		  <th>追加日時</th>
		  <th>URL</th>
		  <th>ステータスコード</th>

		  <th>Check</th>
		  <th>過去履歴</th>
		  <th>Ahref</th>


		  
	  </tr>

    </thead>
    <tbody>
<?php
echo <<<EOT
    <script type="text/javascript" language="javascript">
      function onButtonClick(nos) {
	  var customSwitch = document.getElementById("customSwitch"+ nos);
	  var element = document.getElementById( "output"+ nos ) ;

	          if (customSwitch.checked == true) {

			  element.classList.toggle( "toto" ) ;
			  
			  }
			else {
                
			element.classList.toggle( "toto" ) ;
        }

      }
    </script>
EOT;
	
		$swn=1;//スイッチナンバー
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr id=\"output$swn\" class=\"a\">";   


		echo "<td>".$swn."</td>";
        echo "<td>".$row['move_date']."</td>";
		$url=$row['url_r'];
        echo "<td><a href=".$row['url_r']." target=\"_blank\">".$row['url_r']."</a></td>";
		  		  echo "<td></td>";
		  //stra($url);

echo <<<EOT

  <td>
<div>
  <input type="checkbox"  id="customSwitch$swn" onchange="onButtonClick($swn)">
  <label for="customSwitch$swn">チェック</label>

</div>
EOT;
$swn++;
 
		  //$url="http://archive.org/wayback/available?url=".$row['url_r']."";
		  $url=$row['url_r'];
		  echo "<td><a href=\"http://web.archive.org/web/*/.$url.\" target=\"_blank\">履歴チェック</a></td>";
		  
		  $url="https://ahrefs.com/site-explorer/overview/v2/subdomains/live?target=".$row['url_r']."";
		  echo "<td><a href=".$url." target=\"_blank\">Ahref</a></td>";

         echo "</tr>";
         if($i==999999){
         break;
        }
	$i++;
      }//endwhile
  ?>
      
      <tr>

      </tr>
    </tbody>
</table>
</div>

</div>

</div>
</div>
<?php include("./footer.php");?>
<?php
}catch(Exception $e){
    echo $e->getMessage();
}

?>
