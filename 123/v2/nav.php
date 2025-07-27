<style>
.current{color: darkgreen;}
.logged{font-size: 16px;color: darkgreen}
.logout{margin-left: 20px;}
.logout a{color: cornflowerblue;text-decoration:none }
.logout a:hover{text-decoration: underline}
</style>
<h1>会员注册</h1>
<?php
if (isset($_SESSION['loggedUsername']) && $_SESSION['loggedUsername']<>''){

    ?>
    <div class="logged" >当前登录者:<?php echo $_SESSION['loggedUsername'];?><?php if($_SESSION['isadmin']){ ?><span style="color: gold"> 欢迎管理员登录</span><?php }?> <span class="logout"><a href="logout.php"> 注销登录</a></span> </div>
    <?php
}
//$id= isset($_GET['id'])?$_GET['id']:1;
    $id=$_GET['id'] ?? 1;
?>
<h2>
    <a href="index.php?id=1"<?php if( $id == 1){?> class="current"<?php }?>>首页</a>
    <a href="singup.php?id=2"<?php if( $id == 2){?> class="current"<?php }?>>注册</a>
    <a href="login.php?id=3"<?php if( $id == 3){?> class="current"<?php }?>>登录</a>
    <a href="modify.php?id=4"<?php if( $id == 4){?> class="current"<?php }?>>修改</a>
    <a href="admin.php?id=5"<?php if( $id == 5){?> class="current"<?php }?>>管理</a>
</h2>