<?php
session_start();
include '../connection/connect.php';

$strSQL = "SELECT * FROM member WHERE m_uname = '" . $_POST['txtUsername'] . "' 
	and m_pass = '" . $_POST['txtPassword'] . "'";
$objQuery = mysqli_query($link, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

if (!$objResult) {
    echo "<script type=\"text/javascript\">";
    echo "alert(\"Usernaem หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง !!!\");";
    echo "window.history.back();";
    echo "</script>";
    exit();
} else {
    $_SESSION["UserID"] = $objResult["m_uname"];
    $_SESSION["Status"] = $objResult["m_status"];
    $_SESSION["Confirm"] = $objResult["m_confirm"];

    session_write_close();

    if ($objResult["m_confirm"] == 'yes') {
        if ($objResult["m_status"] != 1){
            header("location:../index_user.php");
        }else {
            header("location:../login_user.php");
        }
    } else {
        header("location:../login_user.php");
    }
}
mysqli_close($link);
?>