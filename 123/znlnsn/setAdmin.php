<?php
include_once 'checkAdmin.php';
$action = $_GET['action'];
$id = $_GET['id'];
if (is_numeric($action) && is_numeric($id)) {
    if( $action == 1 || $action == 0){
        $sql = "update info set admin='$action' where id='$id'";
    }
    else{
        echo"<script>alert('参数错误');history.back();</script>";
    }
    include_once 'conn.php';
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo"<script>alert('设置或取消管理员成功');location.href='admin.php';</script>";
    }
    else{
        echo"<script>alert('设置或取消管理员失败');history.back();</script>";
    }
}
else{
    echo"<script>alert('参数错误');history.back();</script>";
}