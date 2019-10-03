<?php
  include("connection/connect.php");

  if(isset($_POST['check'])){
    $sql = "SELECT * FROM member WHERE m_uname = '".$_POST['ch_uname']."' OR m_mail = '".$_POST['ch_mail']."' OR m_phone = '".$_POST['ch_phone']."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
      $data['check'] = false;
    }else{
      $data['check'] = true;
    }
    echo json_encode($data);
  }

  if(isset($_POST['uname'])){
    $sql = "SELECT * FROM member WHERE m_uname = '".$_POST['uname']."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
      $data['uname'] = false;
    }else{
      $data['uname'] = true;
    }
    echo json_encode($data);
  }

  if(isset($_POST['phone'])){
    $sql = "SELECT * FROM member WHERE m_phone = '".$_POST['phone']."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
      $data['phone'] = false;
    }else{
      $data['phone'] = true;
    }
    echo json_encode($data);
  }

  if(isset($_POST['mail'])){
    $sql = "SELECT * FROM member WHERE m_mail = '".$_POST['mail']."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
      $data['mail'] = false;
    }else{
      $data['mail'] = true;
    }
    echo json_encode($data);
  }

  if(isset($_POST['register'])){
    $sql = "SELECT * FROM member WHERE m_uname = '".$_POST['reg_uname']."' OR m_mail = '".$_POST['reg_mail']."' OR m_phone = '".$_POST['reg_phone']."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) == 0){
      $sql = "INSERT INTO
                member(m_uname,m_pass,m_fname,m_lname,m_phone,m_mail,m_status,m_sector,m_major,m_confirm)
              VALUES('".$_POST['reg_uname']."','".$_POST['reg_pass']."','".$_POST['reg_fname']."','".$_POST['reg_lname']."',
                '".$_POST['reg_phone']."','".$_POST['reg_mail']."','".$_POST['status']."','".$_POST['sector']."','".$_POST['major']."','no')";
      mysqli_query($link,$sql);
      $data['insert'] = true;
    }else{
      $data['insert'] = false;
    }
    echo json_encode($data);
  }

?>
