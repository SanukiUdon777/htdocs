<?php

//http://jyarashi.php.xdomain.jp/test_db3.php

  $dsn = 'mysql:dbname=example; host=localhost; charset=utf8';
  $usr = 'mst';
  $passwd = 'mst';
  $tbl = 'test2';
  
  $data = $_POST['data'];
   

//データベースへの接続
 try 
 {
    	$db = new PDO($dsn, $usr, $passwd);
 } 
 catch (PDOException $e) 
 {
	exit("データベースに接続できません。：{$e->getMessage()}");

 }

//--------------------------------------------------
//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS ". $tbl
."("
. "`no` INT,"
. " `date` DATETIME,"
. "`name` CHAR(10),"
. "`num` INT"
.");";
$stmt = $db -> prepare($sql);
$stmt -> execute();


//--------------------------------------------------
//テーブル件数
$sql = 'select count(*) as cnt from '.$tbl;
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();
//echo "データ数" . ($count+1);
//echo '<br>';

//--------------------------------------------------
// INSERT文を変数に格納
$sql = "INSERT INTO " .$tbl. " ( no, date, name, num ) VALUES ( :no, now(), :name, :num )";
 
// 挿入する値は空のまま、SQL実行の準備をする
$stmt = $db->prepare($sql);
 
// 挿入する値を配列に格納する
$params = array( ':no' => $count+1, ':name' => $data, ':num' => $count*$count );
 
// 挿入する値が入った変数をexecuteにセットしてSQLを実行
$stmt->execute($params);

//--------------------------------------------------
// SELECT文を変数に格納
$sql = "SELECT * FROM " .$tbl;
 
// SQLステートメントを実行し、結果を変数に格納
$stmt = $db->query($sql);
 
// foreach文で配列の中身を一行ずつ出力
foreach ($stmt as $row) {
 
  // データベースのフィールド名で出力
  echo $row['no'] . ' ' . $row['date'] . ' ' . $row['name'] . ' ' . $row['num'];
  echo '<br>';
}







//--------------------------------------------------
// 登録完了のメッセージ
  echo 'end';
  echo '<br>';
?>