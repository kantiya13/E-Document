<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include("../../connection/connect.php"); //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

$m_name = $_POST["txtusername"];
$sql = "SELECT * FROM member WHERE m_uname = '$m_name' ";
$query = mysqli_query($link,$sql);
$num=mysqli_num_rows($query);
if($num > 0){
    echo '<script>alert("ไม่สามารถใช้งาน ชื่อผู้ใช้งานนี้ได้ กรุณาลองใหม่อีกครั้ง");window.history.back();</script>';
}else {
    $confirm = 'no';
    $file = basename($_FILES['upload-file']['name']);
    $path = "uploadfile/" . $file;
    $success = move_uploaded_file($_FILES['upload-file']['tmp_name'], $path);
    if (isset($success)) {
        $strSQL = "INSERT INTO member (m_uname, m_pass, m_fname, m_lname, m_phone, m_mail, m_profile, m_status, m_sector, m_major, m_confirm)
            VALUES ('" . $_POST["txtusername"] . "','" . $_POST["txtpassword"] . "','" . $_POST["txtname"] . "'
            ,'" . $_POST["txtlast"] . "','" . $_POST["txtphone"] . "','" . $_POST["txtemail"] . "','".$file."','" . $_POST["txtstatus"] . "','" . $_POST["txtsector"] . "','" . $_POST["txtmajor"] . "', '" . $confirm . "')";
        $objQuery = mysqli_query($link, $strSQL);
        
    }
    if ($objQuery) {
            echo '<script>alert("สมัครสมาชิกสำเร็จ");window.location.href="../login_user.php";</script>';
        } else {
            echo '<script>alert("สมัครสมาชิกไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง");window.location.href="../login_user.php";</script>';
        }

}

mysqli_close($link);

?>
