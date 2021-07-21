<?php
//Bước 1: Kết nối PHP với MYSQL
    $conn = mysqli_connect('localhost','root','74269852','nckh');

//Bước 2: Thông báo ngôn ngữ sử dụng trong CSDL cho PHP
    mysqli_query($conn,"SET_NAMES 'utf8'");

?>