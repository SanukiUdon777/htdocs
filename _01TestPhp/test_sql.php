<html>
<head>
<title>PHP TEST</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=example;host=localhost';
$user = 'mst';
$password = 'mst';

try
{
    $dbh = new PDO($dsn, $user, $password);

    print('<br>');

    if ($dbh == null)
    {
        print('NG:接続に失敗しました。<br>');
    }
    else
    {
        print('OK:接続に成功しました。<br>');
    
    
        $sql = 'select * from test';
    	foreach ($dbh->query($sql) as $row) 
    	{
        	print($row['a'].',');
        	print($row['b']);
        	print('<br />');
        	print('OK2:接続に成功しました。<br>');
    	}
    	print('OK3:接続に成功しました。<br>');
    }
    
}
catch (PDOException $e){
    print('Error1:'.$e->getMessage());
    die();
}

$dbh = null;

?>


</body>
</html>