<?php
//接続情報を設定
$dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
$user = 'test';
$password = 'test';

try {
    //DB接続
    $connect = new PDO($dsn, $user,$password);
    //todolistテーブルからデータを取得する
    $query = "select * from todolist;";
    $stmt = $connect->query($query);
} catch (PDOException $e) {
    echo 'エラー:'.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ToDo List</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <div id="wrap">
            <h1>ToDo List</h1>
            <form class="todo_list" name="todo_list" action="connect.php" method="POST">
                <div class="main">
                    <div class="input">
                        <input type="text" name="text" class="input_text" placeholder="ここに入力してください。">
                        <button type="submit" class="add_btn" name="data_id" value="" onclick="return validate()">新規追加</button>
                    </div>
                    <div class="output">
                        <ul class="list">
                            <?php foreach ($stmt as $row) { ?> 
                                <!-- DBから取得したデータをセットする -->
                                <li>
                                    <?= htmlspecialchars($row["message"], ENT_QUOTES)?>
                                    <button type="submit" class="delete_btn" name="data_id" value="<?= $row['id'] ?>">削除</button>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <script src="script.js"></script>
    </body>
</html>