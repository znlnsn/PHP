<?php
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$email = $_POST['email'];
$source= $_POST['source'];
$page= $_POST['page'];
//$fav = $_POST['fav'];
//$fav = $_POST['fav']; 如果 fav 是多选框（checkbox），它可能是一个数组，直接拼接到 SQL 会导致错误。
//fav 可能是数组​​（需要 implode() 处理）
$fav = isset($_POST['fav']) ? implode(",", $_POST['fav']) : '';
if(!strlen($username)){
    echo "<script>alert('用户名需要填写');history.back()</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo "<script>alert('用户名必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
        exit;
    }
}
if(!empty($pw)){
    if($pw != $cpw){
        echo "<script>alert('密码和确认密码必须相同');history.back()</script>";
        exit;
    }
    else {
        if (!preg_match('/^[a-zA-Z0-9_*]{6,10}$/', $pw)) {
            echo "<script>alert('密码必填,只能是大小写字母和数字,长度3到10个字符');history.back()</script>";
            exit;
        }
    }
}

    if (empty($email)) {
        if (!preg_match('/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|nat|org){6,10}$/', $email)) {
            echo "<script>alert('信箱格式不正确');history.back()</script>";
            exit;
        }
}
    include_once "conn.php";
    if($pw){
        $sql="update info set pw='".md5($pw)."' ,email='$email' ,sex='$sex',fav='$fav' where username='$username'";
        $url='logout.php';
    }
else{
        $sql="update info set email='$email' ,sex='$sex',fav='$fav' where username='$username'";
        $url='index.php';
}
if($source == 'admin'){
    $url='admin.php?id=5&page='.$page ;
}
$result = mysqli_query($conn, $sql);
if($result){
    echo "<script>alert('更新个人信息成功');location.href='$url'</script>";
}
else{
    echo "<script>alert('更新个人信息失败');history.back()</script>";
}