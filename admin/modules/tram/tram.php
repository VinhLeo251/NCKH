<?php
	if(!defined("TEMPALTE")){
		die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li class="active">Quản lý Tram quan trac</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý Tram quan trac</h1>
			</div>
		</div>
		<!--/.row-->
		<div id="toolbar" class="btn-group">
			<a href="index.php?page_layout=add_tram" class="btn btn-success">
				<i class="glyphicon glyphicon-plus"></i> Thêm Tram quan trac
			</a>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table data-toolbar="#toolbar" data-toggle="table">

							<thead>
								<tr>
									<th data-field="id" data-sortable="true">ID</th>
									<th>Tên tram</th>
									<th>Chi tiet</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//phân trang dữ liệu
								if(isset($_GET["page"])){
									$page=$_GET["page"];
								}
								else{
									$page=1;
								}
								$row_per_page = 5;
								$per_row = $page*$row_per_page-$row_per_page;
								//tạo thanh phân trang
								$total_pages = ceil(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tram"))/$row_per_page);
								$list_page="";
								//page_prev
								$page_prev = $page-1;
								if($page_prev<=0){
									$page_prev=1;
								}
								$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=tram&page='.$page_prev.'">&laquo;</a></li>';
								for($i=1;$i<=$total_pages;$i++){
									$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=tram&page='.$i.'">'.$i.'</a></li>';
								}

								//page next
								$page_next = $page + 1;
								if($page_next>=$total_pages){
									$page_next=$total_pages;
								}
								$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=tram&page='.$page_next.'">&raquo;</a></li>';								
								$sql = "SELECT * FROM tram ORDER BY tram_id ASC LIMIT $per_row,$row_per_page";
									$query = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($query)){
									
								?>
								<tr>
									<td style =""><?php echo $row["tram_id"]?></td>
									<td style =""><?php echo $row["tram_name"]?></td>
									<td> <a href="index.php?page_layout=detail_tram&tram_id=<?php echo $row["tram_id"]?>" class="btn btn-primary"><i>Chi tiet</i></a>
										 </td>
									<td class="form-group">
										<!-- <a href="index.php?page_layout=edit_tram&tram_id=<?php echo $row["tram_id"]?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a> -->
										<a href="del_tram.php?tram_id=<?php echo $row["tram_id"]?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
								</tr>	
								<?php
									}
								?>							
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<nav aria-label="Page navigation example">
							<ul class="pagination">								
								<?php echo $list_page; ?>								
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->
	</div>
	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.js"></script>