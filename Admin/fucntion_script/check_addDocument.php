<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include("../../connection/connect.php"); //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$id = $_GET['id'];
$fileinfo = PATHINFO($_FILES["file"]["name"]);
$newFilename = $fileinfo['filename'] . "_" . time() . "." . $fileinfo['extension'];
$path = 'file/';
$location = $path . $newFilename;
move_uploaded_file($_FILES["file"]["tmp_name"], $location);

$strSQL = "INSERT INTO document(d_id,d_title,d_detail,m_uname,d_datenow,t_type) VALUES('" . $_POST['doc_id'] . "','" . $_POST['title'] . "','" . $location . "','" . $id . "',NOW(),'" . $_POST['type'] . "')";
$objQuery = mysqli_query($link, $strSQL);
mysqli_close($link);
/*
if ($objQuery) {
    echo '<script>alert("สมัครสมาชิกสำเร็จ");window.location.href="../login_user.php";</script>';
} else {
    echo '<script>alert("สมัครสมาชิกไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง");window.location.href="../login_user.php";</script>';
}*/


?>
