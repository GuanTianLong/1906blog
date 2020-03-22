<?php
        //判断session中是否有值
        session_start();                    //开启session
        if(empty($_SESSION['login']['username'])){
            echo "<script>alert('请您先去登录');location.href='/index/login/login.html'</script>";
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博客个人中心</title>
</head>
<body>

        <h3>欢迎<b style="color: hotpink"><?php echo $_SESSION['login']['username']?></b>来到博客个人中心</h3>

        <hr>

        <ul type="square">
            <li><a href="/index/post.php">发帖</a></li>
            <li><a href="">查看文章</a></li>
            <li><a href="">查看回复</a></li>
        </ul>

</body>
</html>