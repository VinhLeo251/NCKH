<?php
if (!defined("TEMPALTE")) {
    die("Bạn không có quyền truy cập vào file này!, quay lại trang <a href=index.php>Login</a>");
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">So lieu Tram</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">So lieu Tram</h1>
        </div>
    </div>
    <!--/.row-->
    <!-- <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_parameter" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr style="text-align: center;">
                                <th>Time update</th>
                                <th>TDS</th>
                                <th>pH</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // //Giải thuật phân trang dữ liệu
                            $tram_id=$_GET["tram_id"];
                            if (isset($_GET["page"])) {
                                $page = $_GET["page"];
                            } else {
                                $page = 1;
                            }
                            $row_per_page = 20;
                            $per_row = $page * $row_per_page - $row_per_page;

                            //Giải thuật tạo thanh phân trang
                            $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM parameter WHERE tram_id=$tram_id")) / $row_per_page);
                            $list_page = "";
                            //page prev
                            $page_prev = $page - 1;
                            if ($page_prev <= 0) {
                                $page_prev = 1;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=detail_tram&tram_id='.$tram_id.'&page=' . $page_prev . '">&laquo;</a></li>';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=detail_tram&tram_id='.$tram_id.'&page=' . $i . '">' . $i . '</a></li>';
                            }

                            //page next										
                            $page_next = $page + 1;
                            if ($page_next > $total_pages) {
                                $page_next = $page;
                            }
                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=detail_tram&tram_id='.$tram_id.'&page=' . $page_next . '">&raquo;</a></li>';

                            $sql = "SELECT * FROM parameter
													WHERE tram_id=$tram_id ORDER BY id DESC LIMIT $per_row,$row_per_page";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td style=""><?php echo $row["time"]; ?></td>
                                    <td style=""><?php echo $row["tds"]; ?></td>
                                    <td style=""><?php echo $row["ph"]; ?></td>
                                    <td style=""><?php echo $row["temperature"]; ?></td>
                                    <td style=""><?php echo $row["humidity"]; ?></td>   
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