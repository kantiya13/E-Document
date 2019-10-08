<?php
  session_start();
  include("../../connection/connect.php");  
  $strSQL = "SELECT * FROM member WHERE m_uname = '".$_POST['inputUsername']."' 
  and m_pass = '".$_POST['inputPassword']."'";
  $objQuery = mysqli_query($link,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
  if(!$objResult)
  {
      echo '<script>alert("ไม่มีบัญชีผู้ใช้นี้");window.location.href="../login.php";</script>';
  }
  else
  {
      $_SESSION["UserID"] = $objResult["m_uname"];
      $_SESSION["Status"] = $objResult["m_status"];
      $_SESSION["Confirm"] = $objResult["m_confirm"];

      session_write_close();
      if ($_SESSION["Confirm"] == 'yes') {
            if($_SESSION["Status"] == 2 || $_SESSION["Status"] == 3)
            {
               header("location: ../index.php");
            }else{
              echo '<script>alert("ไอดีหรือรหัสผ่าน ไม่ถูกต้องกรุณา เข้าสู่ระบบใหม่อีกครั้ง");window.location.href="../login.php";</script>';
            }
        }else{
          echo '<script>alert("ไอดีนี้รอการอนุมัติจากแอดมิน");window.location.href="../login.php";</script>';
        }


  }
  mysqli_close($link);
?>