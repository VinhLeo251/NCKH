<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vietpro Mobile Shop - Administrator</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/success.css" rel="stylesheet">

    <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Vietpro Mobile Shop - Quên mật khẩu</div>
                <div class="panel-body">
                    <?php
                    if (isset($error)) {
                        echo $error;
                    };
                    ?>
                                    <!--	Order Success	-->
                    <div id="order-success">
                        <div class="row">
                            <div id="order-success-img" class="col-lg-3 col-md-3 col-sm-12"></div>
                            
                                <div class="alert alert-success" ><h3>Đặt lại mật khẩu thành công !</h3></div>
                                <div class="alert alert-success" ><p>Vui lòng kiểm tra lại email hoặc liên hệ với quản lý để được cấp lại mật khẩu của bạn.</p></div>                      
                        </div>
                    </div>
                <!--	End Order Success	-->
                            <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Quay lại trang đăng nhập</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</body>

</html>