<?php 
session_start();
include("../connection/connect.php");
$id = $_GET['id'];

$sqlss = "SELECT * FROM document WHERE d_docid = '".$_GET['id']."' ";
$queryss = mysqli_query($link, $sqlss);
$resultss=mysqli_fetch_array($queryss,MYSQLI_ASSOC);
//echo $resultss['d_detail'];

if($_POST['title']){
    $sql = "UPDATE document SET d_title = '" . $_POST['title'] . "',m_uname = '" . $_SESSION['UserID'] . "',d_datenow = NOW(),t_type = '" .$_POST['type'] . "',from_user = '".$_SESSION['UserID']."' WHERE d_docid ='$id' ";
    $objQuery = mysqli_query($link, $sql);
    $i = 0;
    if (count($_POST['namemail']) == 0) {
        $sql = "INSERT INTO document(d_docid,d_title,d_detail,m_uname,d_datenow,t_type,to_user,from_user,join_doc)
                              VALUES('" . $_POST['docid'] . "','" . $_POST['title'] . "','". $resultss['d_detail'] ."','" . $_SESSION['UserID'] . "',NOW(),'" . $_POST['type'] . "','AllUser','" . $_SESSION['UserID'] . "','ยืนยันการเข้าร่วม')";
        $objQuery = mysqli_query($link, $sql);
    } else {
        while ($i < count($_POST['namemail'])) {
            $sql = "INSERT INTO document(d_docid,d_title,d_detail,m_uname,d_datenow,t_type,to_user,from_user,join_doc) VALUES('" . $_POST['docid'] . "','" . $_POST['title'] . "','" . $resultss['d_detail'] . "','" . $_SESSION['UserID'] . "',NOW(),'" . $_POST['type'] . "','" . $_POST['namemail'][$i] . "','" . $_SESSION['UserID'] . "','ยืนยันการเข้าร่วม')";
            $objQuery = mysqli_query($link, $sql);
            $i++;
            if (!$objQuery){
                echo "<script type=\"text/javascript\">";
                echo "alert(\"ส่งไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
                echo "window.history.back();";
                echo "</script>";
                exit();
            }else {
                echo "<script type=\"text/javascript\">";
                echo "alert(\"ส่งสำเร็จ\");";
                echo "window.history.back();";
                echo "</script>";
                exit();
            }
        }
    }
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
}

//while ($i < count($_POST['namemail'])) {
//    $sql = "INSERT INTO document(d_docid,d_title,m_uname,d_datenow,t_type,to_user,from_user,join_doc) VALUES('" . $id . "','" . $_POST['title'] . "','" . $_SESSION['UserID'] . "',NOW(),'" . $_POST['type'] . "','" . $_POST['namemail'][$i] . "','" . $_SESSION['UserID'] . "','ยืนยันการเข้าร่วม')";
//    $objQuery = mysqli_query($link, $sql);
//    $i++;
//}

//if (!$objQuery){
//    echo "<script type=\"text/javascript\">";
//    echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
//    echo "window.history.back();";
//    echo "</script>";
//    exit();
//}else {
//    echo "<script type=\"text/javascript\">";
//    echo "alert(\"อัพเดทข้อมูลเรียบร้อยแล้ว\");";
//    echo "window.history.back();";
//    echo "</script>";
//    exit();
//}
//
//if ($_POST['namemail'] != ''){
//
//}

?>