<?php
    session_start();
    if(isset($_SESSION["mail"]) && isset($_SESSION["pass"])){
        unset($_SESSION["mail"]);
        unset($_SESSION["pass"]);
    }
    header("location: index.php");
?>