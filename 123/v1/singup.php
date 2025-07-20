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
        <a href="singup.php" class="current">注册</a>
        <a href="login.php">登录</a>
        <a href="modify.php">修改</a>
        <a href="admin.php">管理</a>
    </h2>
<!--    当点击提交按钮会跳转到postReg.php     onsubmit当点击提交先检查-->
    <form action="postReg.php" method="post" onsubmit="return check()">
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
                <td align="right">确认密码</td>
                <td align="left"><input type="password" name="cpw"><span class="red">*</span></td>
            </tr>

            <tr>
                <td align="right">邮箱</td>
                <td align="left"><input  name="email"></td>
            </tr>
            <tr>
                <td align="right">性别</td>
                <td align="left">
                    <input  name="sex" type="radio" checked value="1">男
                    <input  name="sex" type="radio"  value="0">女
                </td>
            </tr>
            <tr>
                <td align="right">爱好</td>
                <td align="left">
                    <input  name="fav[]" type="checkbox" value="听音乐">听音乐
                    <input  name="fav[]" type="checkbox"  value="玩游戏">玩游戏
                    <input  name="fav[]" type="checkbox"  value="踢足球">踢足球</td>
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
        let cpw =document.getElementsByName('cpw')[0].value.trim();
        let email =document.getElementsByName('email')[0].value.trim();
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
        else {
            if(pw!=cpw){
                alert('密码和确认密码要一致');
                return false;
            }
        }

        let emailReg=/^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|nat|org)$/;
        if(email.length>0){
            if(!emailReg.test(email)){
                alert('信箱格式不正确');
                return false;
            }
        }

        return true;
        }
</script>
</body>
</html>