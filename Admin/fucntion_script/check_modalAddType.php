<?php
include("../../connection/connect.php");

$strSQL = "INSERT INTO type (t_name) 
		VALUES ('".$_POST["typename"]."')";

$objQuery = mysqli_query($link,$strSQL);



if($objQuery) {
    echo '<script>alert("บันทึกข้อมูลสำเร็จ");window.history.back();</script>';
}else {
    echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ");window.history.back(;</script>';
}


mysqli_close($link);
?>
