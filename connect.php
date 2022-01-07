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
    
    if($data_id === "") {
        //入力データを登録
        $query = "insert into todolist(message) values('$text');";
        $stmt = $connect->prepare($query);
        $stmt->execute();
    } else {
        //リストを削除する
        $query = "delete from todolist where id = :id;";
        $stmt = $connect->prepare($query);
        $stmt->bindValue(':id', $data_id);
        $stmt->execute();
    }
} catch (PDOException $e) {
    echo 'DB接続エラー:'.$e->getMessage();
}

//リダイレクト
header("Location: index.php");
exit;
?>