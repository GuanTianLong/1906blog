<?php

        /**
            *接收表单值
         */
        $username = $_POST['username'];
        $pass = md5($_POST['pass']);
        $confirm_pass = md5($_POST['confirm_pass']);
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];

        /**
            *验证
         */
        $reg_username = "/^[a-z]\w{5,15}$/i";                                 //定义正则表达式(用户名由6-16位的字母数字下划线组成，不能由数字开头)
        if(empty($username)){
            die("用户名名必填");
        }else if(!preg_match($reg_username,$username)){
            die("用户名由6-10位的字母数字下划线组成，不能由数字开头");
        }

        $reg_pass = "/^\w{6,}$/";                                           //定义正则表达式(密码长度数字、字母、下划线组成不能少于六位)
        if(empty($pass)){
            die("密码必填");
        }else if(!preg_match($reg_pass,$pass)){
            die("密码长度数字、字母、下划线组成不能少于六位");
        }

        if(empty($confirm_pass)){
            die("确认密码必填");
        }else if ($confirm_pass != $pass){
            die("确认密码与密码不一致");
        }

        $reg_mobile = "/^1[3,4,5,6,7,8,9]\d{9}$/";                          //定义正则表达式(验证手机号:11位,13,14,15,16,17,18,19开头)
        if(empty($mobile)){
            die("手机号必填");
        }else if (!preg_match($reg_mobile,$mobile)){
            die("手机号格式不正确，请您输入正确的手机号");
        }

        $reg_email = "/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/";          //定义正则表达式
        if(empty($email)){
            die("邮箱必填");
        }else if(!preg_match($reg_email,$email)){
            die("邮箱格式不正确，请您输入正确的邮箱");
        }

        //数据库用户名
        $user = 'root';
        //数据库密码
        $password = 'root';

        //连接数据库
        $dbh = new PDO('mysql:host=localhost;dbname=1906blog', $user, $password);
        //var_dump($dbh);

        //准备SQL语句
        $sql = "SELECT * FROM b_users WHERE username= ?";
        //准备SQL模板
        $stmt = $dbh->prepare($sql);
        //绑定参数
        $stmt->bindParam(1,$username);
        //执行SQL查询
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //var_dump($row);die;

        //用户名唯一性验证
        if($row)
        {
            header('Refresh:2;url=/index/register/register.html');
            echo "用户名已存在！请您重新注册";die;
        }else{
            //准备SQL语句
            $sql1 = "INSERT INTO b_users (username,pass,mobile,email) VALUES (?,?,?,?)";

            $stmt = $dbh->prepare($sql1);                    //准备SQL模板
            $stmt->bindParam(1,$username);
            $stmt->bindParam(2,$pass);
            $stmt->bindParam(3,$mobile);
            $stmt->bindParam(4,$email);

            //执行SQL语句
            $data = $stmt->execute();

            //返回自增ID
            //$id = $dbh->lastInsertId();
            //echo "自增ID：".$id;

            header('Refresh:2;url=/index/login/login.html');
            echo "注册成功！";

        }



