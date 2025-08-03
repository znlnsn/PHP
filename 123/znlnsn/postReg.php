<?php
header("Content-type:text/html;charset=utf-8");
//trim()可以把前后空格去掉表单验证
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$email = $_POST['email'];
//$fav = $_POST['fav'];
//$fav = $_POST['fav']; 如果 fav 是多选框（checkbox），它可能是一个数组，直接拼接到 SQL 会导致错误。
//fav 可能是数组​​（需要 implode() 处理）
$fav = isset($_POST['fav']) ? implode(",", $_POST['fav']) : '';

//echo "你输入的用户是:".$username."<br>";
//echo "你输入的密码是:{$pw} <br>";
//echo "你输入的确认密码是:".$cpw."<br>";
//echo "你输入的性别是:";
//echo $sex == 1 ? '男':'女';//如果等于1输出男不等于1输出女
//echo "<br>";
//echo "你喜欢的爱好是:";
//$fav=implode(",",$fav);
//echo $fav;


include_once "conn.php";

mysqli_query($conn, "set names utf8");

if(!strlen($username) || !strlen($pw)){
    echo "<script>alert('用户名和密码都需要填写');history.back()</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('用户名必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
        exit;
    }
}

if($pw != $cpw){
    echo "<script>alert('密码和确认密码必须相同');history.back()</script>";
    exit;
}
else {
    if (!preg_match('/^[a-zA-Z0-9_*]{6,10}$/', $pw)) {
        echo "<script>alert('密码必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
        exit;
    }
    if (empty($email)) {
        if (!preg_match('/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|nat|org){6,10}$/', $email)) {
            echo "<script>alert('信箱格式不正确');history.back()</script>";
            exit;
        }
    }

    $sql = "select * from info where username='$username'";
    $result = mysqli_query($conn, $sql);//返回一个记录集
    $num = mysqli_num_rows($result);//显示行里面的记录数
    if ($num) {
        echo "<script>alert('用户名已被占用,请重新输入');history.back()</script>";
        exit;
    }
//$sex 后面缺少单引号 '，导致 SQL 语法错误。
    $sql = "insert into  info (username,pw,sex,email,fav,createTime) values ('$username','" . md5($pw) . "','$sex','$email','$fav','" . time() . "')";

//$sql = "insert into info(username,pw,sex,email,fav,creatime) values('".$username."','".md5($pw)."','".$sex."','".$email."','".$fav."','".time()."')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('数据插入成功');location.href='index.php';</script>";
    } else {
        // mysqli_error() 应该传入数据库连接对象 $conn，而不是 SQL 语句 $sql。
        echo "<script>alert('数据插入失败: " . mysqli_error($conn) . "');history.back()</script>";
    }
    mysqli_close($conn);
}