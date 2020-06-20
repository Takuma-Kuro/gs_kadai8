<?php
//1.POSTでデータを取得
$name = $_POST["name"];
$email = $_POST["email"];
$text = $_POST["naiyou"];
$id = $_POST["id"];

//2.DB接続など
require "funcs.php";
$pdo = db_conn();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れと同じです。
$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:value2,email=:value3,text=:value4 WHERE id= :id");
$stmt->bindValue('value2', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('value3', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('value4', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false) {
    //SQLエラー関数
  }else{

   //一覧ページへ戻す
    redirect('select.php');
  }
?>