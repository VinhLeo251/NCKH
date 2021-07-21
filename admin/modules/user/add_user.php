<?php
	if(!defined("TEMPALTE")){
		die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
	}
?>
<?php
	if(isset($_POST["sbm"])){

		$user_full = $_POST["user_full"];
		$user_mail = $_POST["user_mail"];
		$user_pass = $_POST["user_pass"];
		$user_re_pass = $_POST["user_re_pass"];		
		$user_level = $_POST["user_level"];
		
		//check trùng mail
		$sqlCheck = "SELECT * FROM user WHERE user_mail = '$user_mail'";
		$queryCheck = mysqli_query($conn,$sqlCheck);
		$num = mysqli_num_rows($queryCheck);

		//check mail hợp lệ
		$kytu = '#^[a-z0-9\._]{3,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
		//$kytu_pass = '#^[a-z0-9]{6,31}$#';		
		if(preg_match($kytu,$user_mail,$match)==0){
			$error_kytu = '<div class="alert alert-danger">Email không hợp lệ !</div>';
		}
		// else if(preg_match($kytu,$user_pass,$match)==0){
		// 	$error_kytu_pass = '<div class="alert alert-danger">Mật khẩu không hợp lệ !</div>';
		// }
		else if(strlen($user_pass) < 6) //check pass
		{
			$error_strlen = '<div class="alert alert-danger">Mật khẩu không đủ 6 ký tự !</div>';
		}
		else if($num){
			$error_mail = '<div class="alert alert-danger">Email đã tồn tại !</div>';
		}
		else{
			if($user_pass!=$user_re_pass){ //check pass
				$error_pass = '<div class="alert alert-danger">Mật khẩu không trùng nhau !</div>';
			}
			else{
				$sql = "INSERT INTO user(
							user_full,
							user_mail,
							user_pass,
							user_level
						)
						VALUES(
							'$user_full',
							'$user_mail',
							'$user_pass',
							'$user_level'
						)";
				$query = mysqli_query($conn,$sql);
				header('location:index.php?page_layout=user');
			}
		}
	}
		
	
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li><a href="index.php?page_layout=user">Quản lý thành viên</a></li>
				<li class="active">Thêm thành viên</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm thành viên</h1>
			</div>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
							<?php 	
								if(isset($error_kytu)) {echo $error_kytu;}	
								//if(isset($error_kytu_pass)) {echo $error_kytu_pass;}
								if(isset($error_strlen)){echo $error_strlen;}
								if(isset($error_mail)){ echo $error_mail; }
								if(isset($error_pass)){ echo $error_pass; }
							?>
							<!-- <div class="alert alert-danger">Email đã tồn tại !</div> -->
							<form role="form" method="post">
								<div class="form-group">
									<label>Họ & Tên</label>
									<input name="user_full" required class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input name="user_mail" required type="text" class="form-control">
								</div>
								<div class="form-group">
									<label>Mật khẩu</label>
									<input name="user_pass" required type="password" class="form-control">
								</div>
								<div class="form-group">
									<label>Nhập lại mật khẩu</label>
									<input name="user_re_pass" required type="password" class="form-control">
								</div>
								<div class="form-group">
									<label>Quyền</label>
									<select name="user_level" class="form-control">
										<option value=1>Admin</option>
										<option value=2>Member</option>
									</select>
								</div>
								<button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
								<button type="reset" class="btn btn-default">Làm mới</button>
						</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

	</div>
	<!--/.main-->