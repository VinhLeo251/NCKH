<?php
	if(!defined("TEMPALTE")){
		die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
	}
?>
<?php
	if(isset($_POST["sbm"])){
		$cat_name = $_POST["cat_name"];

		$sql_check = "SELECT * FROM category WHERE cat_name = '$cat_name'";
		$query_check = mysqli_query($conn,$sql_check);
		$check = mysqli_num_rows($query_check);	

		if($check)
		{
			$error='<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
		}
		else{
			$sql = "INSERT INTO category(
						cat_name
					)
					VALUES(
						'$cat_name'
					)";
			$query = mysqli_query($conn,$sql);
			header('location:index.php?page_layout=tram.php');
		}
		
	}
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li><a href="index.php?page_layout=category">Quản lý Tram quan trac</a></li>
				<li class="active">Thêm Tram</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm Tram</h1>
			</div>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
							<?php if(isset($error)) {echo $error;} ?>
							<!-- <div class="alert alert-danger">Danh mục đã tồn tại !</div> -->
							<form role="form" method="post">
								<div class="form-group">
									<label>Tên Tram:</label>
									<input required type="text" name="cat_name" class="form-control" placeholder="Tên tram...">
								</div>
								<button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
								<button type="reset" class="btn btn-default">Làm mới</button>
						</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div>
		<!--/.main-->