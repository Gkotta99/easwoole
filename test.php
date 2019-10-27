<?php

$dbms = 'mysql';     //数据库类型
$host = '106.12.76.185'; //数据库主机名
$dbName = 'test';    //使用的数据库
$user = 'root';      //数据库连接用户名
$pass = '5db7fc47188f64c9';          //对应的密码
$dsn = "$dbms:host=$host;dbname=$dbName";

try {
    $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
    foreach ($dbh->query('SELECT * from video') as $row) {
        print_r($row);
    }
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}