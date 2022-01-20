<?php
//入力内容を変数に格納する
$text = $_POST['text'];
$data_id = $_POST['data_id'];

//接続情報を設定
$dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
$user = 'test';
$password = 'test';

try {
    //DB接続
    $connect = new PDO($dsn, $user,$password);
    //todolistテーブルからデータを取得する
    $query = "select * from todolist where id = :id;";
    $stmt = $connect->prepare($query);
    $stmt->bindValue(':id', $data_id);
    $stmt->execute();
} catch (PDOException $e) {
    echo 'DB接続エラー:'.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>Edit Mode</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <div id="wrap">
            <h1>ToDoリスト</h1>
            <div class="main-wrap">
                <h2>編集画面</h2>
                <form class="todo_list" name="todo_list" action="update.php" method="POST">
                    <div class="main">
                        <div class="output">
                                <?php foreach ($stmt as $row) { ?> 
                                    <!-- DBから取得したデータをセットする -->
                                    <input type="text" name="text" class="base" value="<?= htmlspecialchars($row["message"], ENT_QUOTES)?>"><br>
                                    <button type="submit" class="btn edit_btn edit_mode" name="data_id" value="<?= $row['id'] ?>" onclick="return validate()">更新</button>
                                    <button type="button" class="btn back_btn" onclick="history.back()">戻る</button>
                                <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>