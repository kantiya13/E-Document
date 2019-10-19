<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database:
include("../../connection/connect.php"); //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$id = $_GET['id'];
$file = basename($_FILES['upload-file']['name']);
$path = "upload_file/" . $file;
$success = move_uploaded_file($_FILES['upload-file']['tmp_name'], $path);
if (isset($success)) {
    $strSQL = "INSERT INTO document(d_id,d_title,d_detail,m_uname,d_datenow,t_type) VALUES('" . $_POST['doc_id'] . "','" . $_POST['title'] . "','".$file."','".$id."',NOW(),'" . $_POST['type'] . "')";
    $objQuery = mysqli_query($link, $strSQL);
    if(count($_POST['all_mail']) == 0){
        $sql = "INSERT INTO send(s_to,s_document,s_form) VALUES('AllUser','".sprintf("%05d",($id+1))."','".$uname."')";
        mysqli_query($link,$sql);
    }else{
        while($i < count($_POST['all_mail'])){
            $sql = "INSERT INTO send(s_to,s_document,s_form) VALUES('".$_POST['all_mail'][$i]."','".sprintf("%05d",($id+1))."','".$uname."')";
            mysqli_query($link,$sql);
            $i++;
        }
    }
}
mysqli_close($link);
/*
if ($objQuery) {
    echo '<script>alert("สมัครสมาชิกสำเร็จ");window.location.href="../login_user.php";</script>';
} else {
    echo '<script>alert("สมัครสมาชิกไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง");window.location.href="../login_user.php";</script>';
}*/


?>
