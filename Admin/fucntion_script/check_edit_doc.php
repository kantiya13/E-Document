<?php 
session_start();
include("../connection/connect.php");
$id = $_GET['id'];

                $file = basename($_FILES['upload-file']['name']);
                $path = "../upload_file/".$file;
                $success = move_uploaded_file($_FILES['upload-file']['tmp_name'],$path);
                if($success){
                    $sql = "UPDATE document SET d_title = '" . $_POST['title'] . "',d_detail = '" .$file. "' 
                        ,m_uname = '" . $_SESSION['UserID'] . "',d_datenow = NOW(),t_type = '" .$_POST['type'] . "',from_user = '".$_SESSION['UserID']."' WHERE d_id ='$id' ";
                        $objQuery = mysqli_query($link, $sql);
                
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
                }else{
                    $sql = "UPDATE document SET d_title = '" . $_POST['title'] . "'
                        ,m_uname = '" . $_SESSION['UserID'] . "',d_datenow = NOW(),t_type = '" .$_POST['type'] . "',from_user = '".$_SESSION['UserID']."' WHERE d_id ='$id' ";
                        $objQuery = mysqli_query($link, $sql);
                
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

?>