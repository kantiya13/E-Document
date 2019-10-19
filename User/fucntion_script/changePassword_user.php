<?php
session_start();
include("../connection/connect.php");

$strSQLcheck = "SELECT * FROM member WHERE m_pass = '" . $_POST['txtOldPassword'] . "'";
$objQuerycheck = mysqli_query($link, $strSQLcheck);
$objResultcheck = mysqli_fetch_array($objQuerycheck, MYSQLI_ASSOC);

if ($_POST["txtOldPassword"] != $objResultcheck["m_pass"]) {
    echo "<script type=\"text/javascript\">";
    echo "alert(\"รหัสผ่านเดิมไม่ถูกต้อง!!!\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
}

if ($_POST["txtNewPassword"] != $_POST["txtConPassword"]) {
    echo "<script type=\"text/javascript\">";
    echo "alert(\"รหัสผ่านใหม่ไม่ตรงกัน!!!\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
} else {
    $strSQL = "UPDATE member SET m_pass = '" . trim($_POST['txtNewPassword']) . "' WHERE m_uname = '" . $_SESSION["UserID"] . "' ";
    $objQuery = mysqli_query($link, $strSQL);
    if (!$objQuery) {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
        echo "window.history.back();";
        echo "</script>";
        exit();
    } else {
        echo '<script>alert("อัพเดทข้อมูลสำเร็จแล้ว กรุณาเข้าสู่ระบบอีกครั้ง ขอบคุณค่ะ");window.location.href="logout_user.php"</script>';
        exit();
    }
}
mysqli_close($link);
?>