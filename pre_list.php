<?php

function stra( $url ) {
  $ch = curl_init( $url );
  curl_setopt( $ch, CURLOPT_HEADER, true ); // we want headers
  curl_setopt( $ch, CURLOPT_NOBODY, true ); // we don't need body
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_TIMEOUT, 2 );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  $output = curl_exec( $ch );
  $httpcode = curl_getinfo( $ch, CURLINFO_RESPONSE_CODE );
  curl_close( $ch );

  //echo 'HTTP code: ' . $httpcode;
  echo "<td>" . $httpcode . "</td>";
}


//DBに接続する。
$USER = 'manabou_list';
$PW = 'amo22726';
$dnsinfo = "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";


try {
  $pdo3 = new PDO( $dnsinfo, $USER, $PW );
  $sql3 = "SET @i := 0;
	UPDATE PRE SET id = (@i := @i +1);";
  $stmt3 = $pdo3->prepare( $sql3 );
  $stmt3->execute( null );

  $pdo = new PDO( $dnsinfo, $USER, $PW );
  $sql = "SELECT * FROM PRE";
  $stmt = $pdo->prepare( $sql );
  $stmt->execute( null );


  $pdo2 = new PDO( $dnsinfo, $USER, $PW );
  $sql2 = "SELECT * FROM TABLE1";
  $stmt2 = $pdo->prepare( $sql2 );
  $stmt2->execute( null );
  $res = "";
  $i = 1;

  ?>
<?php include('./head.php');?>
      <div class="container-fluid mb-2">
        <input type="button" class="sample_btn" value="ajax通信で取得する">
        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="bs-component">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center"> 取得可能ドメイン <span class="badge badge-primary badge-pill">14</span> </li>
                <li class="list-group-item d-flex justify-content-between align-items-center"> 取得済みドメイン <span class="badge badge-primary badge-pill">2</span> </li>
                <li class="list-group-item d-flex justify-content-between align-items-center"> ブラックリストドメイン <span class="badge badge-primary badge-pill">1</span> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="response0"></div>
          <table id="fav-table" class="table table-bordered sort-table table-hover">
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
              <script type="text/javascript" language="javascript">
function onButtonClick(nos) {
	
	var customSwitch = document.getElementById("customSwitch"+ nos);
	var element = document.getElementById( "output"+ nos ) ;

if (customSwitch.checked == false) {

	element.classList.toggle( "toto" ) ;
	console.log('.result'+ nos);

    //.sampleをクリックしてajax通信を行う
    $('.sample_btn').click(function(){
        $.ajax({
            url: '/tool/ajax2.php',
            type: 'GET',
            dataType: 'text',
            data : {
                no : nos
            }
			
        }).done(function(data){
            /* 通信成功時 */
            $('.result'+ nos).text(data); //取得したHTMLを.resultに反映
            
        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });

			  
	}//if
else if (customSwitch.checked == true){
                
	element.classList.toggle( "toto" ) ;
	console.log(100);
	
    //.sampleをクリックしてajax通信を行う
    $('.sample_btn').click(function(){
        $.ajax({
            url: '/tool/ajax.php',
            type: 'GET',
            dataType: 'text',
            data : {
                no : nos
            }
        }).done(function(data){
            /* 通信成功時 */
            $('.result'+ nos).text(data); //取得したHTMLを.resultに反映
            
        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });

 }//elseif

}//endif
    </script>
              <?php
              echo <<<EOT
EOT;

              $swn = 1; //スイッチナンバー
              while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {

                if ( $swn % 2 != 0 ) {
                  echo "<tr id=\"output$swn\" class=\"table-primary\">";
                } else {
                  echo "<tr id=\"output$swn\" class=\"table-secondary\">";

                }


                echo "<td>" . $row[ 'id' ] . "</td>";
                echo "<td>" . $row[ 'move_date' ] . "</td>";
                $url = $row[ 'url_r' ];
                echo "<td><a href=" . $row[ 'url_r' ] . " target=\"_blank\">" . $row[ 'url_r' ] . "</a></td>";
                echo "<td><div class=\"result$swn\">未取得</div></td>";
                //stra($url);
                $chke = "checked";
                if ( $row[ 'black' ] == 0 or $row[ 'black' ] == NULL ) {
                  echo <<<EOT

  <td>
<div>
  <input type="checkbox"  id="customSwitch$swn" onchange="onButtonClick($swn)" value="$url" class="abc sample_btn">
  <label for="customSwitch$swn">チェック</label>

</div>
EOT;

                } elseif ( $row[ 'black' ] == 1 ) {

                  echo <<<EOT

  <td>
<div>
  <input type="checkbox"  id="customSwitch$swn" onchange="onButtonClick($swn)" value="$url" class="abc sample_btn" checked="$chke">
  <label for="customSwitch$swn">チェック</label>

</div>
EOT;
                }


                $swn++;

                //$url="http://archive.org/wayback/available?url=".$row['url_r']."";
                $url = $row[ 'url_r' ];
                echo "<td><a href=\"http://web.archive.org/web/*/.$url.\" target=\"_blank\">履歴チェック</a></td>";


                $url = "https://ahrefs.com/site-explorer/overview/v2/subdomains/live?target=" . $row[ 'url_r' ] . "";

                echo "<td><a href=" . $url . " target=\"_blank\">Ahref</a></td>";

                echo "</tr>";
                if ( $i == 999999 ) {

                  break;
                }
                $i++;
              } //endwhile
              ?>
              <tr> </tr>
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
