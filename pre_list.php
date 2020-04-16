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
	 <caption>My Favorite Album</caption>
 <table id="fav-table" class="table table-bordered sort-table">
  <thead class="thead-inverse">
	  <tr>
		  <th>
		    過去履歴</th>
		  <th>Add Date</th>
		  <th>URL</th>
		  <th>Check</th>
		  <th>過去履歴</th>


		  
	  </tr>

    </thead>
    <tbody>

<?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr>";   



        echo "<td>".$row['move_date']."</td>";
        echo "<td>".$row['url_r']."</td>";
	
  echo <<<EOT
  <td>
  			<form method=".post." action="">
			<input type="checkbox" name="food[]" value="寿司"> ブラックリスト
			<input type="checkbox" name="food[]" value="天ぷら"> コメントスパム
			<input type="checkbox" name="food[]" value="芸者"> ２オーナー
			</form>
	</td>
EOT;
		  
		  $url="http://archive.org/wayback/available?url=".$row['url_r']."";
		  echo "<td>".$url."</td>";
			  


         echo "</tr>";
         if($i==99999){
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
