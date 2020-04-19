<?php
include "head.php";
ini_set('max_execution_time', 90000);
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
/* HTML特殊文字をエスケープする関数 */
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// パラメータを正しい構造で受け取った時のみ実行
if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {

    try {

        /* ファイルアップロードエラーチェック */
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                // エラー無し
                break;
            case UPLOAD_ERR_NO_FILE:
                // ファイル未選択
                throw new RuntimeException('File is not selected');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                // 許可サイズを超過
                throw new RuntimeException('File is too large');
            default:
                throw new RuntimeException('Unknown error');
        }

        $tmp_name = $_FILES['upfile']['tmp_name'];
        $detect_order = 'ASCII,JIS,UTF-8,CP51932,SJIS-win';
        setlocale(LC_ALL, 'ja_JP.UTF-8');

        /* 文字コードを変換してファイルを置換 */
        $buffer = file_get_contents($tmp_name);
        if (!$encoding = mb_detect_encoding($buffer, $detect_order, true)) {
            // 文字コードの自動判定に失敗
            unset($buffer);
            throw new RuntimeException('Character set detection failed');
        }
        file_put_contents($tmp_name, mb_convert_encoding($buffer, 'UTF-8', $encoding));
        unset($buffer);

        /* データベースに接続 */
        $pdo = new PDO(
            'mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8',
            'manabou_list',
            'amo22726',
            array(
                // カラム型に合わない値がINSERTされようとしたときSQLエラーとする
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='TRADITIONAL'",
                // SQLエラー発生時にPDOExceptionをスローさせる
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // プリペアドステートメントのエミュレーションを無効化する
                PDO::ATTR_EMULATE_PREPARES => false,
            )
        );
        $stmt = $pdo->prepare('INSERT INTO TABLE1 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        /* トランザクション処理 */
        $pdo->beginTransaction();
        try {
            $fp = fopen($tmp_name, 'rb');
            while ($row = fgetcsv($fp)) {
				
				//カンマが含まれてたら除去
				$i=0;
				
				while($i<23){
					
					//echo $row[$i];
					$row[$i] = str_replace(',',".",$row[$i]);

					//echo "<br>";
					$i++;
					
					}
		/* $row[0]	=NULL;
		$row[1]	=NULL;*/


		$url=$row[9];
		echo $url;
		//URLをパースして分解する
        $parse_url=parse_url($url);
		$main_sub="sakura";

        //$parse_url["host"]にドメイン・サブドメインの部分がパースされて格納される
        $ar_host = array_reverse(explode('.',$parse_url["host"]));
        $ht = array_reverse(explode('.',$parse_url["scheme"]));
        $ar_host[1]=$ar_host[1].'.'.$ar_host[0];
		
        unset($ar_host[0]);
		
		if ($ar_host[2]==$main_sub){
			//print_r ($ar_host);
			//print_r($ht);
			//print_r($ar_host);
			    $url_merge = array_merge($ht, $ar_host);
				
        		$hs="://";
        		$hs2=".";
        		$hs3="/";
        		$pieces = [$url_merge[0],$hs,$url_merge[3],$hs2, $url_merge[2],$hs2, $url_merge[1],$hs3];
		}
		else {
        //配列を結合する
         		$url_merge = array_merge($ht, $ar_host);
         		$hs="://";
         		$hs2=".";
         		$hs3="/";
        		$pieces = [$url_merge[0],$hs, $url_merge[2],$hs2, $url_merge[1],$hs3];
		}
		$url=implode($pieces);
		//最後尾に正規化したデータをpush
		array_push($row, $url);
		//print_r($row);
		print_r($row);
		echo "!<br>";
		
				//バリデータ
		$sql3 = "DELETE FROM TABLE1 WHERE COL24 = '$url'";
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->execute(null);
				
			
		//バリデータ
		$sql3 = "DELETE FROM TABLE1 WHERE COL1 = '#'";
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->execute(null);
				
				
				
				
                if ($row === array(null)) {
                    // 空行はスキップ
                    continue;
                }
                if (count($row) !== 24) {
                    // カラム数が異なる無効なフォーマット
                    throw new RuntimeException('Invalid column detected');
                }
                $executed = $stmt->execute($row);
            }
            if (!feof($fp)) {
                // ファイルポインタが終端に達していなければエラー
                throw new RuntimeException('CSV parsing error');
            }
            fclose($fp);
            $pdo->commit();
        } catch (Exception $e) {
            fclose($fp);
            $pdo->rollBack();
            throw $e;
        }

        /* 結果メッセージをセット */
        if (isset($executed)) {
            // 1回以上実行された
            $msg = array('green', 'Import successful');
        } else {
            // 1回も実行されなかった
            $msg = array('black', 'There were nothing to import');
        }

    } catch (Exception $e) {

        /* エラーメッセージをセット */
        $msg = array('red', $e->getMessage());

    }

}

// XHTMLとしてブラウザに認識させる
// (IE8以下はサポート対象外ｗ)


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">




<?php if (isset($msg)): ?>
<fieldset>
    <legend>Result</legend>
    <span style="color:<?=h($msg[0])?>;"><?=h($msg[1])?></span>
</fieldset>
<?php endif; ?>


	
	

  <form enctype="multipart/form-data" method="post" action="">
    <fieldset>


  <div class="form-check">
    <input type="file" name="upfile" class="form-check-input" id="exampleCheck1">
   
  </div><br><br><br>
  <button type="submit" class="btn btn-primary" value="Upload">Submit</button>
    </fieldset>
</form>
<br>
<br>

<?php include("./footer.php");?>