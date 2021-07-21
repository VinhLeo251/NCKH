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
<title>NCKH</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<?php
					include_once('modules/menu/header.php');
				?>
			</nav>
		
	<?php
		include_once('modules/menu/menu.php');
	?>
	
	<?php
		if(isset($_GET["page_layout"])){
			switch($_GET["page_layout"]){
				
				case "tram": include_once("modules/tram/tram.php");
				break;

				case "add_tram": include_once("modules/tram/add_tram.php");
				break;

				case "add_parameter": include_once("modules/tram/add_parameter.php");
				break;

				case "detail_tram": include_once("modules/tram/detail_tram.php");
				break;

				case "user": include_once("modules/user/user.php");
				break;

				case "add_user": include_once("modules/user/add_user.php");
				break;

				case "edit_user": include_once("modules/user/edit_user.php");
				break;


			}
		}
		else{
			// include_once("dashboard.php");
		}
	?>
	
</body>

</html>
