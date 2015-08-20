<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AccKK | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <?= css('bootstrap.min.css') ?>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Theme style -->
        <?= css('AdminLTE.min.css') ?>
        <!-- iCheck -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Acc</b>KK</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">เข้าระบบเพื่อเริ่มใช้งาน</p>
                <?= form_open('login') ?>
                <div class="form-group has-feedback">
                    <input type="text" name="userid" class="form-control" placeholder="User ID">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="userpass" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าระบบ</button>
                    </div><!-- /.col -->
                </div>
                <?= form_close() ?>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <?= js('jquery-2.1.4.js') ?>
        <!-- Bootstrap 3.3.4 -->
        <?= js('bootstrap.min.js') ?>
    </body>
</html>
