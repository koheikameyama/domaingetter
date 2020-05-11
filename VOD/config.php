<?php


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

<div class="container-fluid mb-2">

	  <div class="row">

	    <div class="col-4"><form type="button" class="btn btn-info"　method="post" action="db_drop.php">データベース初期化<input type="submit"></form></div>
	   </div>
</div>

<div class="container-fluid">
<div class="row">
            <div class="col-md">
                <form>
                    <div class="form-group">
                        <label>部署</label>
                        <select class="form-control">
                            <option>さくらサーバー</option>
   
                        </select>
                    </div>
                </form>
            </div>
        </div>
<label>メインドメイン</label>  
<div class="form-group">
  <label for="text1">ドメイン</label>
  <input type="text" id="text1" class="form-control" >sakura.ne.jp
</div>


	
	
	
</div>

<div class="row center-block text-center">
            <div class="col-1">
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-outline-secondary btn-block">閉じる</button>
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-outline-primary btn-block">新規登録</button>
            </div>
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
