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
$strSQL = "UPDATE type SET t_name = '" .$_POST['t_name'] . "' WHERE t_id = '$id' ";
$objQuery = mysqli_query($link, $strSQL);

if (!$objQuery){
    echo "<script type=\"text/javascript\">";
    echo "alert(\"อัพเดทข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
}else {
    echo "<script type=\"text/javascript\">";
    echo "alert(\"อัพเดทข้อมูลเรียบร้อยแล้ว\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
}

mysqli_close($link);
?>