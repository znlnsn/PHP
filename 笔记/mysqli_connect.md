<?php
$conn = mysqli_connect("hostname","databaseuser","databasepass","database");
if(!$conn){
    die("数据库连接失败");
}
