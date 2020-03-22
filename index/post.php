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
    <title>博客发帖页</title>
</head>
<body>
    <h3>欢迎<b style="color: hotpink"><?php echo $_SESSION['login']['username'];?></b>来发帖：</h3>
    <form action="" method="post">
        <textarea name="content" id="" cols="70" rows="10" placeholder="请输入要发表的内容..."></textarea>
        <input type="submit" value="发帖">
    </form>
</body>
</html>