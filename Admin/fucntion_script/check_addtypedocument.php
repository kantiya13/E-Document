<?php
include("../../connection/connect.php");

$strSQL = "INSERT INTO type (t_name) 
		VALUES ('".$_POST["typename"]."')";

$objQuery = mysqli_query($link,$strSQL);



if($objQuery) {
    echo '<script>alert("บันทึกข้อมูลสำเร็จ");window.location.href="../editdocument_admin.php";</script>';
}else {
    echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ");window.location.href="../editdocument_admin.php";</script>';
}


mysqli_close($link);
?>
