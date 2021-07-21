<?php    
    function checkComment($comm_details){
        $conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "vietpro_mobile_shop"
        );
        $sql_cmt = "SELECT * FROM key_work";
        $query_cmt = mysqli_query($conn, $sql_cmt);
        $arr_comm = [];
        while ($row= mysqli_fetch_array($query_cmt)){
            array_push($arr_comm, "#".$row['key_details']."#");
        };
        $replace = "***";
        $comm_details = preg_replace($arr_comm , $replace , $comm_details  ) ;
        return $comm_details;
    };    
?>