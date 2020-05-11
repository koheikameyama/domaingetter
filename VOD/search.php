<?php
    //postデータを受け取る
    $ken = $_POST&#91;'request'&#93;;
    
    //受け取ったデータが空でなければ
    if (!empty($ken)) {
    
        //pdoインスタンス生成
        $pdo = new PDO ('mysql:host=localhost;dbname=local', '【ユーザー名】', '【パスワード】');
        //SQL文作成
        $sql = "select city from local.test where prefecture = '".$ken."'";
        //SQL実行
        $results = $pdo->query($sql);
        //出力ごにょごにょ
        echo '<table class="list_table">';
        echo "<tr>";
        echo "<th>市町村</th>";
        echo "</tr>";
        //データベースより取得したデータを一行ずつ表示する
        foreach ($results as $result) {
            echo "<tr>";
            echo "<td>".$result['city']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    
    //空だったら
    } else {
        echo '<p id="tekito">エラー：都道府県を選択して下さい。</p>';
    }
    
?>