<?php
ob_start();
include "../PHPMailer-master/src/PHPMailer.php";
include "../PHPMailer-master/src/Exception.php";
include "../PHPMailer-master/src/OAuth.php";
include "../PHPMailer-master/src/POP3.php";
include "../PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;	
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vietpro Mobile Shop - Administrator</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <?php
    include_once("connect.php");
    session_start();
    define("TEMPLATE", True);
    if (isset($_POST["sbm"])) {
        $email = $_POST["mail"];
        $sql = "SELECT * FROM user WHERE `user_mail` = '$email'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $rows = mysqli_num_rows($query);
        if ($rows > 0) {
            $new_pass = bin2hex(random_bytes(6));
            $str_body = 'Email của bạn là: '.$email.'<br> Mật khẩu mới của bạn là: '.$new_pass;
            $sql_update = "UPDATE `user` SET `user_pass`= '$new_pass' WHERE `user_mail` = '$email'";
            $query = mysqli_query($conn, $sql_update);
            $mail = new PHPMailer(true);                              // Passing 'true' enables exceptions
            try {
                //Server settings


                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'vietpro.shop28@gmail.com';//'anhnhatdev2504@gmail.com';                 // SMTP username
                // $mail->Password = 'vietpr0sh0p';                           // SMTP password
                $mail->Password = 'rnqqtpbwsivtqopl';//'aooetapcleuuisun';                           // SMTP password
                $mail->SMTPSecure = 'tls';//'ssl';                            // Enable TLS encryption, 'ssl' also accepted
                $mail->Port = 587;//465;                                   // TCP port to connect to


                // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                // $mail->isSMTP();                                      // Set mailer to use SMTP
                // $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                // $mail->SMTPAuth = true;                               // Enable SMTP authentication
                // $mail->Username = 'anhnhatdev2504@gmail.com';                 // SMTP username
                // // $mail->Password = 'vietpr0sh0p';                           // SMTP password
                // $mail->Password = 'aooetapcleuuisun';                           // SMTP password
                // $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, 'ssl' also accepted
                // $mail->Port = 465;                                   // TCP port to connect to
            
                //Recipients
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('quantri.vietproshop@gmail.com', 'Vietpro Mobile Shop');				// Gửi mail tới Mail Server
                $mail->addAddress($email);               // Gửi mail tới mail người nhận
                //$mail->addReplyTo('ceo.vietpro@gmail.com', 'Information');
                $mail->addCC('quantri.vietproshop@gmail.com');
                //$mail->addBCC('bcc@example.com');
            
                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Mật khẩu mới của tài khoản '. $email;
                $mail->Body    = $str_body;
                $mail->AltBody = 'Quên mật khẩu';
            
                $mail->send();
                header('location:success.php');
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            $error = '<div class="alert alert-danger">Email không hợp lệ !</div>';
        };
    };
    ?>
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
                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input require class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-warning">Lấy lại mật khẩu</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</body>

</html>