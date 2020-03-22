<?php

        $account    = $_POST['account'];
        $pass       = md5($_POST['pass']);

        //数据库用户名
        $user = 'root';
        //数据库密码
        $password = 'root';

        //连接数据库
        $dbh = new PDO('mysql:host=localhost;dbname=1906blog', $user, $password);

        //准备SQL语句
        $sql = "SELECT * FROM b_users WHERE username=? OR mobile=? OR email=?";

        //准备SQL模板
        $stmt = $dbh->prepare($sql);
        //绑定参数
        $stmt->bindParam(1,$account);
        $stmt->bindParam(2,$account);
        $stmt->bindParam(3,$account);
        //执行SQL查询
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data){
            //判断数据库中的密码与输入的密码是否一致
            if($pass != $data['pass']){
                header('Refresh:2;url=/index/login/login.html');
                echo "您输入的密码不正确，请您重新输入！";die;
            }else{
                //将用户名存入session中
                session_start();                    //开启session

                $_SESSION['login'] = array('id' => $data['id'],'username' => $data['username']);
                header('Refresh:2;url=/index/personal/personal.php');
                echo "登录成功，正在跳转至博客个人中心...";
            }

        }else{
                header('Refresh:2;url=/index/login/login.html');
                echo "此用户名不存在！";
        }
