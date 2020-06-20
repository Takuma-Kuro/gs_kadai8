<?php
// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "funcs.php";
$pdo = db_conn();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM gs_kadai2_table WHERE id=:id");
$stmt->bindvalue(":id",$id,PDO::PARAM_INT);//PDO::PARAM_STR
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
  //SQLエラー関数
  sql_error($stmt);

}else{
  $row = $stmt->fetch();
  
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
    <fieldset>
    <legend>データ編集</legend>
      <label>名前：<input type="text" name="name" value="<?=$row['name']?>"></label><br>
      <label>Email：<input type="text" name="email" value="<?=$row['email']?>"></label><br>
      <label><textArea name="naiyou" rows="4" cols="40"><?=$row['text']?></textArea></label><br>
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>