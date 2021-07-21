<?php
	if(!defined("TEMPALTE")){
		die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
	}
?>
<?php
	//đổ dữ liệu
	$user_id = $_GET["user_id"];
	$sql_display = "SELECT * FROM user WHERE user_id = '$user_id'";
	$query_display = mysqli_query($conn,$sql_display);
	$row = mysqli_fetch_array($query_display);
	$old_mail = $row["user_mail"];

	//check dữ liệu
	if(isset($_POST["sbm"])){
		$user_full = $_POST["user_full"];
		$user_mail = $_POST["user_mail"];
		$user_pass = $_POST["user_pass"];
		$user_re_pass = $_POST["user_re_pass"];		
		$user_level = $_POST["user_level"];
	//check mail đã tồn tại chưa, nếu tồn tại rồi thì báo lỗi và có thể giữ nguyên mail cũ
		$sql_check = "SELECT * FROM user WHERE user_mail != '$old_mail'";
		$query_check = mysqli_query($conn,$sql_check);
		$count = 0;
		while($row_check = mysqli_fetch_array($query_check)){		
			if($row_check["user_mail"]==$user_mail){
				$count++;
			}
		}
		$kytu = '#^[a-z0-9\._]{3,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';	
		if($count>0){
			$error_mail_1 = '<div class="alert alert-danger">Email đã tồn tại !</div>';			
		}else if(preg_match($kytu,$user_mail,$match)==0){
			$error_mail_2 = '<div class="alert alert-danger">Email không hợp lệ !</div>';
		}else if($user_pass != $user_re_pass){
			$error_pass_1 = '<div class="alert alert-danger">Mật khẩu không khớp !</div>';
		}else if(strlen($user_pass)<6 && strlen($user_re_pass)<6){
			$error_pass_2 = '<div class="alert alert-danger">Mật khẩu không đủ 6 ký tự !</div>';		
		}else{
			$sql_update = "UPDATE user
							SET
							user_full = '$user_full',
							user_mail = '$user_mail',
							user_pass = '$user_pass',
							user_level = '$user_level'
							WHERE user_id = '$user_id'";
			
			$query_update = mysqli_query($conn,$sql_update);
			header('location:index.php?page_layout=user');
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
				<li class="active"><?php echo $row["user_full"]; ?></li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thành viên: <?php echo $row["user_full"]; ?></h1>
			</div>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
							<?php 
								if(isset($error_mail_1)) echo $error_mail_1;
								if(isset($error_mail_2)) echo $error_mail_2;
								if(isset($error_pass_1)) echo $error_pass_1;
								if(isset($error_pass_2)) echo $error_pass_2;
							?>
							<!-- <div class="alert alert-danger">Email đã tồn tại !</div> -->
							<form role="form" method="post">
								<div class="form-group">
									<label>Họ & Tên</label>
									<input type="text" name="user_full" required class="form-control" value="<?php echo $row["user_full"]; ?>" placeholder="">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="user_mail" required value="<?php echo $row["user_mail"]; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>Mật khẩu</label>
									<input type="password" name="user_pass" required class="form-control">
								</div>
								<div class="form-group">
									<label>Nhập lại mật khẩu</label>
									<input type="password" name="user_re_pass" required class="form-control">
								</div>
								<div class="form-group">
									<label>Quyền</label>
									<select name="user_level" class="form-control">
										<option <?php if($row["user_level"]==1) echo 'selected'; ?> value=1>Admin</option>
										<option <?php if($row["user_level"]==2) echo 'selected'; ?> value=2>Member</option>
									</select>
								</div>
								<button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
								<button type="reset" class="btn btn-default">Làm mới</button>
						</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

	</div>
	<!--/.main-->