<?php
  	include("../../connection/connect.php");
  	$confirm = 'no';

		  $strSQL = "INSERT INTO member (m_uname, m_pass, m_fname, m_lname, m_phone, m_mail, m_profile, m_status, m_sector, m_major, m_confirm) 
		VALUES ('".$_POST["txtusername"]."','".$_POST["txtpassword"]."','".$_POST["txtname"]."'
		,'".$_POST["textlast"]."','".$_POST["txtphone"]."','".$_POST["txtemail"]."','".$_POST["txtimg"]."','".$_POST["txtstatus"]."','".$_POST["txtsector"]."','".$_POST["txtmajor"]."', '".$confirm."')";

		 $objQuery = mysqli_query($link,$strSQL);



		 if($objQuery) {
			echo '<script>alert("สมัครสมาชิกสำเร็จ");window.location.href="../login.php";</script>';
		 }else {
			echo '<script>alert("สมัครสมาชิกไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง");window.location.href="../login.php";</script>';
		 }


	mysqli_close($link);
?>
