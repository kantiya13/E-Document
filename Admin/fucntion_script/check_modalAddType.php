<?php
include("../../connection/connect.php");
$t_name = $_POST["typename"];
$sql = "SELECT * FROM type WHERE t_name = '$t_name' ";
$query = mysqli_query($link,$sql);
$num=mysqli_num_rows($query);
if($num > 0){
    echo '<script>alert("หมวดหมู่นี้ มีอยู่อยู่แล้ว");window.history.back();</script>';
}else {
    $strSQL = "INSERT INTO type (t_name) 
		VALUES ('".$_POST["typename"]."')";
    $objQuery = mysqli_query($link,$strSQL);
    if($objQuery) {
        echo '<script>alert("บันทึกข้อมูลสำเร็จ");window.history.back();</script>';
    }else {
        echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ");window.history.back(;</script>';
    }
}

mysqli_close($link);
?>
