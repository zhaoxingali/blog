
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="stylesheet" href="<?php echo base_url() ;?>public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <style>
    .container,.container .login {
        margin:0 auto;
    }
    .container h1{
        text-align: center;
    }
    .container .login{
        width:23%;
    }
    .error{
        font-size: 12px;
        color:red;
    }
    </style>

    <div class="container">
       <div class="jumbotron">
            <h1>欢迎登陆</h1>
            <div class="login">
                <form role="form" action="<?php echo base_url(); ?>index.php/Login/check" method="POST">
                    <h5>管理员账户</h5>
                    <input type="text" name="username" class="form-control"  value="" size="50" />
                    <h5>密码</h5>
                    <input type="password" class="form-control"  name="password" value="" size="50" />
                    <span>
                    <span class="error">
                        <?php 
                            if (isset($mess) && $mess!='') {
                                echo $mess;
                            }
                        ?>
                    </span>
                    </span>
                    <label for=""><input type="submit" class="btn btn-default" value="Submit" /></label>

                </form>
            </div>
       </div>
    </div> 
</body>
</html>


