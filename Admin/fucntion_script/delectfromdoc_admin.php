<?php
session_start();
include("../connection/connect.php");
$id = $_GET['id'];

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}

$strSQL = "DELETE FROM fromdocument WHERE f_id = '".$id."' ";
$objQuery = mysqli_query($link, $strSQL);

if (!$objQuery){
    echo "<script type=\"text/javascript\">";
    echo "alert(\"ลบข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
}else {
    echo "<script type=\"text/javascript\">";
    echo "alert(\"ลบข้อมุลสำเร็จ\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
}

mysqli_close($link);
?>