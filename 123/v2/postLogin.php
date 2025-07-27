<?php
session_start();
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
if(!strlen($username) || !strlen($pw)){
    echo "<script>alert('用户名和密码都需要填写');history.back()</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('用户名必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
        exit;
    }
    if (!preg_match('/^[a-zA-Z0-9_*]{6,10}$/', $pw)) {
        echo "<script>alert('密码必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
        exit;
    }
}

include_once "conn.php";
$sql = "select * from info  where username='$username' and pw='".md5($pw)."'";
$result=mysqli_query($conn, $sql);
$num=mysqli_num_rows($result);
if($num){
    $_SESSION['loggedUsername']=$username;
    //判断是不是管理员
    $info=mysqli_fetch_array($result);
    if($info[('admin')]){
        $_SESSION['isadmin']=1;
    }
    else{
        $_SESSION['isadmin']=0;
    }
    echo "<script>alert('登录成功');location.href='index.php';</script>";
}
else{
    unset($_SESSION['isadmin']);
    unset($_SESSION['loggedUsername']);
    echo "<script>alert('登录失败');history.back();</script>";
}