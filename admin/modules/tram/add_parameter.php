<?php
if (!defined("TEMPALTE")) {
	die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
}
?>
<?php
	if(isset($_POST["sbm"])){

		//bassic

		$time = date('Y-m-d H:i:s');
		$tds = $_POST["tds"];
		$ph = $_POST["ph"];
		$temperature = $_POST["temperature"];
		$humidity = $_POST["humidity"];
		$tram_id=$_POST["tram_id"];		

		$sql = "INSERT INTO parameter(
				time,
				tds,
				ph,
				temperature,
				humidity,
				tram_id)
			VALUES('$time',
				'$tds',
				'$ph',
				'$temperature',
				'$humidity',
				'$tram_id')";
			echo $sql;
		$query = mysqli_query($conn,$sql);		
		header('location:index.php?page_layout=detail_tram&tram_id='.$tram_id.'');		
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
			<li class="active">Thêm sản phẩm</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm sản phẩm</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-6">
						<form role="form" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>TDS</label>
								<input required name="tds" class="form-control" placeholder="">
							</div>

							<div class="form-group">
								<label>pH</label>
								<input required name="ph" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Temprature</label>
								<input required name="temperature" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Humidity</label>
								<input required name="humidity" type="text" class="form-control">
							</div>
                            <div class="form-group">
							<label>Tram</label>
							<select name="tram_id" class="form-control">
								<?php
								$sql = "SELECT * FROM tram order by tram_id ASC";
								$query = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_array($query)) {
								?>
									<option value=<?php echo $row["tram_id"]; ?>><?php echo $row["tram_name"]; ?></option>
								<?php
								}
								?>
							</select>
						</div>

						<button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        </form>
					</div>
					
					
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

</div>
<!--/.main-->