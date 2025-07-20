<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理系统</title>
    <style>
        .main{width: 80%;margin: 0 auto;text-align: center;}
        h2 a{color:navy;text-decoration: none; margin-right: 15px;}
        h2 a:last-child{margin-right: 0;}
        h2 a:hover{color: brown;text-decoration: underline;}
        .current{color: darkgreen;}
        .red {color: red}
    </style>
</head>
<body>

<div class="main">
    <h1>会员注册</h1>
    <h2>
        <a href="index.php" >首页</a>
        <a href="singup.php" >注册</a>
        <a href="login.php" class="current">登录</a>
        <a href="modify.php">修改</a>
        <a href="admin.php">管理</a>
    </h2>
    <!--    当点击提交按钮会跳转到postReg.php     onsubmit当点击提交先检查-->
    <form action="postLogin.php" method="post" onsubmit="return check()">
        <table align="center" border="1" style="border-collapse:collapse" cellpadding="10" cellspacing="0";>
            <tr>
                <td align="right">用户名</td>
                <td align="left"><input name="username"><span class="red">*</span>  </td>
            </tr>
            <tr>
                <td align="right">密码</td>
                <td align="left"><input type="password" name="pw"><span class="red">*</span></td>
            </tr>
            <tr>
                <td align="right"><input type="submit" value="提交"></td>
                <td align="left"><input type="reset" value="重置" ></td>
            </tr>
        </table>
    </form>
</div>
<script>
    function check(){
        let username =document.getElementsByName('username')[0].value.trim() ;
        let pw =document.getElementsByName('pw')[0].value.trim();
        let usernameReg=/^[a-zA-Z0-9]{3,10}$/;
        if(!usernameReg.test(username)){
            alert('用户名必填,只能是大小写字母和数字,长度3到10个字符');
            return false;
        }
        let pwReg=/^[a-zA-Z0-9_*]{6,10}$/;
        if(!pwReg.test(pw)){
            alert('用户名必填,只能是大小写字母和数字,*和_,长度6到10个字符');
            return false;
        }

        return true;
    }
</script>
</body>
</html>