<?php
  include("connection/connect.php");

  $sql = "SELECT * FROM member WHERE m_mail LIKE '%".$_POST['input']."%' AND m_status != 1 AND m_status != 4";
  $result = mysqli_query($link,$sql);
  $array = [];
  $row = mysqli_num_rows($result);
  if(mysqli_num_rows($result)){
    while($mem = mysqli_fetch_assoc($result)){
      $array = $mem['m_mail'].'|';
      echo $array;
    }
  }
?>
