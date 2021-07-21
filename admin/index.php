<script src="ckeditor/ckeditor.js"></script>
<?php
    ob_start();
    include_once('connect.php');
    session_start();
    define("TEMPALTE",true);
    if(isset($_SESSION["mail"]) && isset($_SESSION["pass"])){
        include_once("admin.php");
    }
    else{
        include_once("login.php");
    }
?>