<?php
session_start();
include("../connection/connect.php");
$id = $_GET['id'];
if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_user.php");
} elseif ($_SESSION["Status"] == 1) {
    header("location:login_user.php");
}

$strSQL = "UPDATE member SET m_fname = '" . trim($_POST['txtFname']) . "',m_lname = '" . trim($_POST['txtlname']) . "' 
,m_mail = '" . trim($_POST['txtEmail']) . "',m_phone = '" . trim($_POST['txtPhone']) . "' 
WHERE m_uname = '$id' ";
$objQuery = mysqli_query($link, $strSQL);

if (!$objQuery){
    echo "<script type=\"text/javascript\">";
    echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
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