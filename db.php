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



<table class="table table-striped table-inverse table-responsive">
  <thead class="thead-inverse">

    </thead>
    <tbody>

<?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr>";   
		echo "<td>".$row['COL 1']."</td>";
		//echo "<td>".$row['COL 2']."</td>";
		//echo "<td>".$row['COL 3']."</td>";
		//echo "<td>".$row['COL 4']."</td>";
        //echo "<td>".$row['COL 5']."</td>";
        //echo "<td>".$row['COL6']."</td>";
		//echo "<td>".$row['COL7']."</td>";
		//echo "<td>".$row['COL8']."</td>";
		echo "<td>".$row['COL 9']."</td>";
        echo "<td>".$row['COL10']."→".$row['COL24']."</td>";
        //echo "<td>".$row['COL 11']."</td>";
		//echo "<td>".$row['COL 12']."</td>";
		//echo "<td>".$row['COL 13']."</td>";
		//echo "<td>".$row['COL 14']."</td>";
       // echo "<td>".$row['COL 15']."</td>";
        //echo "<td>".$row['COL 16']."</td>";
		//echo "<td>".$row['COL 17']."</td>";
		//echo "<td>".$row['COL 18']."</td>";
		//echo "<td>".$row['COL 19']."</td>";
        //echo "<td>".$row['COL 20']."</td>";
       // echo "<td>".$row['COL 21']."</td>";
       // echo "<td>".$row['COL 23']."</td>";



         echo "</tr>";
         if($i==999999999){
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
