<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
<form method="post" action="insert.php">
  <h1>北海道の名所をオススメ！！</h1>
  <div class="jumbotron">

    <button class="randombutton">ランダムで名所を表示</button>
  </div>
</form>
<!-- Main[End] -->
<script>
$(".randombutton").on("click", function () {
    var random = Math.floor(Math.random() * 40);
    console.log(random); 
</script>
</body>
</html>
