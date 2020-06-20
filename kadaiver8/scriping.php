<?php
// phpQueryの読み込み
require_once("phpQuery-onefile.php");
// HTMLの取得
$doc = phpQuery::newDocumentFile("https://www.tabirai.net/sightseeing/feature/hokkaido-kanko.aspx");
 
foreach ($doc[".faciList"]->find(".section") as $entry){
    //タイトル
    $h2 = pq($entry)->find('h2')->text();
    //サブタイトル
    $h3 = pq($entry)->find('h3')->text();
    //内容
    $info = pq($entry)->find('.textWrap')->text();
    //料金
    $tex = pq($entry)->find('.text')->text();
    //画像
    $ima = pq($entry)->find('.photo')->attr('data-original');

    //配列に格納
    $scrapingData[] = ['title' => $h2, 'subti' => $h3, 'info' => $info, 'text' => $tex, 'image' => $ima];
}
// 
//var_dump($scrapingData);

function db_conn() {
    try{
        $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
}

$pdo = db_conn();
$stmt = $pdo->prepare("INSERT INTO gs_kadai2_table(id,title,subti,info,text,image) VALUES(null,:title,:subti,:info,:text,:image)");


//配列から取り出して１店舗づつ追加
foreach($scrapingData as $value) {
    $title = $value["title"];
    $subti = $value["subti"];
    $info = $value["info"];
    $text = $value["text"];
    $image = $value["image"];

    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":subti", $subti, PDO::PARAM_STR);
    $stmt->bindValue(":info", $info, PDO::PARAM_STR);
    $stmt->bindValue(":text", $text, PDO::PARAM_STR);
    $stmt->bindValue(":image", $image, PDO::PARAM_STR);

    $status = $stmt->execute();

    if($status==false){
        $error = $stmt->errorInfo();
        exit("SQLError:".$error[2]);
    }else{
    }
}

?>

