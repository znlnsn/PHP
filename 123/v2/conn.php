<?php
$conn = mysqli_connect("localhost","root","root","member");
if(!$conn){
    die("数据库连接失败");
}