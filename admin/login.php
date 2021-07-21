<?php
	if(!defined("TEMPALTE")){
		die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Phòng Thí Nghiệm Điện- Điện Tử</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="stylesheet" href="css/login.css">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php
		
		$time_lock = 10; //đặt thời gian tài khoản bị khóa
		//tạo biến lưu số lần đăng nhập lỗi
		if(isset($_COOKIE['error'])){
			$dem = $_COOKIE['error'];
		}else{
			$dem = 0;
		}

		if(isset($_POST["login"]))
		{			
			$mail=$_POST["mail"];
			$pass=$_POST["pass"];
			$sql = "SELECT * FROM user where user_mail = '$mail' and user_pass = '$pass' LIMIT 1";
			$query = mysqli_query($conn,$sql);
			$nums = mysqli_num_rows($query);
			if($nums > 0){
						
				$_SESSION["mail"]=$mail;
				$_SESSION["pass"]=$pass;
				$row = mysqli_fetch_array($query);		
				$_SESSION["name"] = $row["user_full"];

				//setcookie('error',$dem, time() - 3600);
				unset($_COOKIE["error"]);//hủy cookie nếu login thành công
				header('location: index.php');
			}
			else{
				$dem++;
				setcookie('error',$dem, time() + 86400);//thời gian lưu số lần đăng nhập lỗi là 1 ngày, có thể lưu lâu hơn hoặc ngắn hơn
				$error = '<div class="alert alert-danger">Tài khoản không hợp lệ ! (Bạn đã nhập sai '.$dem.' lần)</div>';
			}				
		}
	?>
	<div class="banner_login"></div>
	<div class="detail_login">
	<div class="row">
		<div class="col-xs-8 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Login to system</div>
				<div class="panel-body">
					<?php
						if(isset($error)){
							echo $error;
						}
						if(isset($_POST["rs_pass"]))
						{
							header('location:rs_pass.php');
						}
					?>
					<?php 
					if($dem <= 3)
					{
					?>
					<!-- <div class="alert alert-danger">Đăng nhập thất bại!</div> -->
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input required class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<div class="form-group">
								<input required class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
							<button style="float: right;" type="submit" class="btn btn-warning" name="rs_pass">Quên mật khẩu</button>
						</fieldset>
					</form>
					<?php
					}
					else 
					{
						setcookie('error', $dem, time() + $time_lock);//thời gian khóa đăng nhập là 60s
						?>
						<div class="alert alert-danger">Bạn đã bị khoá đăng nhập trong 1 phút do nhập sai quá 3 lần!</div>
					
					<?php 
					} 
					?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row --></div>	
</body>

</html>
