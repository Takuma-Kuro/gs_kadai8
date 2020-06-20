<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
// $name = $_POST["name"];
// $email = $_POST["email"];
// $naiyou = $_POST["naiyou"];


//2. DB接続します
require "funcs.php";
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_kadai2_table(id,title,subti,info,text,image) VALUES(null,:title,:subti,:info,:text,:image)");
$stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":subti", $subti, PDO::PARAM_STR);
    $stmt->bindValue(":info", $info, PDO::PARAM_STR);
    $stmt->bindValue(":text", $text, PDO::PARAM_STR);
    $stmt->bindValue(":image", $image, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');

}


?>
