<?php
  include("connection/connect.php");
  session_start();
  ob_start();
  $sql = "SELECT * FROM member WHERE m_uname = '".$_GET['id']."'";
  $result = mysqli_query($link,$sql);
  if(mysqli_num_rows($result) == 0){
    header("location:pages-error-404.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <?php
        include("header.php");
      ?>
      <?php
        include("navbar.php");
      ?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">โปรไฟล์</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">หน้าแรก</a></li>
                            <li class="breadcrumb-item active">โปรไฟล์</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <?php
                  $sql = "SELECT * FROM member INNER JOIN status WHERE m_uname = '".$_GET['id']."' AND m_status = s_id";
                  $result = mysqli_query($link,$sql);
                  if(mysqli_num_rows($result) > 0){
                    while($mem = mysqli_fetch_assoc($result)){
                      $fname = $mem['m_fname'];
                      $lname = $mem['m_lname'];
                      $uname = $mem['m_uname'];
                      $phone = $mem['m_phone'];
                      $mail = $mem['m_mail'];
                      $pass = $mem['m_pass'];
                      $profile = $mem['m_profile'];
                      $status = $mem['s_name'];
                    }
                  }
                  if(isset($_POST['update'])){
                    $ext = pathinfo(basename($_FILES['picture']['name']),PATHINFO_EXTENSION);
                    $img_name = 'img_'.uniqid().'.'.$ext;
                    $img_path = 'assets/images/users/';
                    $upload_img = $img_path.$img_name;
                    $success = move_uploaded_file($_FILES['picture']['tmp_name'],$upload_img);
                    if($success){
                      if($profile != ''){
                        @unlink($img_path.$profile);
                      }
                      $sql = "UPDATE member SET m_status = '".$_POST['status']."', m_fname = '".$_POST['fname']."', m_lname = '".$_POST['lname']."', m_phone = '".$_POST['phone']."', m_mail = '".$_POST['mail']."', m_profile = '".$img_name."' WHERE m_uname = '".$_GET['id']."'";
                      mysqli_query($link,$sql);
                      echo '<script>window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                    }else{
                      $sql = "UPDATE member SET m_status = '".$_POST['status']."', m_fname = '".$_POST['fname']."', m_lname = '".$_POST['lname']."', m_phone = '".$_POST['phone']."', m_mail = '".$_POST['mail']."' WHERE m_uname = '".$_GET['id']."'";
                      mysqli_query($link,$sql);
                      echo '<script>window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                    }
                  }
                  if(isset($_POST['change_pass'])){
                    if(strlen($_POST['oldpass']) > 7 && strlen($_POST['oldpass']) < 17){
                      if(strlen($_POST['newpass']) > 7 && strlen($_POST['newpass']) < 17){
                        if($_POST['oldpass'] != $pass){
                          echo '<script>alert("รหัสผ่านไม่ถูกต้อง");window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                        }else{
                          if($_POST['conpass'] != $_POST['newpass']){
                            echo '<script>alert("รหัสผ่านไม่ตรงกัน");window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                          }else{
                            $sql = "UPDATE member SET m_pass = '".$_POST['newpass']."' WHERE m_uname = '".$uname."'";
                            mysqli_query($link,$sql);
                            echo '<script>window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                          }
                        }
                      }else{
                        echo '<script>alert("รหัสผ่านต้องมี 8 - 16 ตัวอักษร");window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                      }
                    }else{
                      echo '<script>alert("รหัสผ่านต้องมี 8 - 16 ตัวอักษร");window.location.href="manage_list.php?id='.$_GET['id'].'"</script>';
                    }
                  }
                ?>

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form method="post" class="row" enctype="multipart/form-data">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div style="height:315px;" class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                  <input id="select_pic" type="file" name="picture" class="d-none" accept="image/*">
                                  <div id="change_pic" style="line-height:150px;" class="overlay align-middle">เปลี่ยนรูป</div>
                                  <img id="show_pic" src="assets/images/users/<?php if($profile == ""){echo 'no_profile.png';}else{echo $profile;} ?>" class="img-circle" width="150" height="150" />
                                    <h4 class="card-title m-t-10"><?php echo $fname.' '.$lname; ?></h4>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <div class="form-horizontal form-material">
                                  <form method="post" class="row">
                                    <?php
                                      $sql = "SELECT m_confirm FROM member WHERE m_uname = '".$_GET['id']."'";
                                      $result = mysqli_query($link,$sql);
                                      if(mysqli_num_rows($result) > 0){
                                        while($mem = mysqli_fetch_assoc($result)){
                                          $confirm = $mem['m_confirm'];
                                        }
                                      }
                                      if(isset($_POST['confirm'])){
                                        $sql = "UPDATE member SET m_confirm = 'yes' WHERE m_uname = '".$_GET['id']."'";
                                        mysqli_query($link,$sql);
                                        header("location:manage_list.php?id=".$_GET['id']);
                                      }
                                      if(isset($_POST['notconfirm'])){
                                        $sql = "UPDATE member SET m_confirm = 'no' WHERE m_uname = '".$_GET['id']."'";
                                        mysqli_query($link,$sql);
                                        header("location:manage_list.php?id=".$_GET['id']);
                                      }
                                    ?>
                                    <div class="form-group col-12 text-right">
                                      <?php
                                        if($confirm == 'yes'){
                                          echo '<p class="float-left text-success">อนุมัติแล้ว</p>';
                                        }else{
                                          echo '<p class="float-left text-danger">ยังไม่อนุมัติ</p>';
                                        }
                                      ?>
                                      <?php
                                        if($confirm == 'yes'){
                                          echo '<input class="btn btn-warning" type="submit" name="notconfirm" value="ยกเลิกการอนุมัติ">';
                                        }
                                        if($confirm == 'no'){
                                          echo '<input class="btn btn-success" type="submit" name="confirm" value="อนุมัติ">';
                                        }
                                      ?>
                                    </div>
                                  </form>
                                    <div class="row">
                                      <div class="form-group col-12">
                                          <label class="col-md-6">สถานะ</label>
                                          <div class="col-md-6">
                                              <select class="form-control" name="status">
                                                <?php
                                                  $sql = "SELECT * FROM status WHERE s_id != 1 ORDER BY s_id ASC";
                                                  $result = mysqli_query($link,$sql);
                                                  while($sta = mysqli_fetch_assoc($result)){
                                                    echo '<option';
                                                    if($status == $sta['s_name']){
                                                      echo ' selected';
                                                    }
                                                    echo ' value="'.$sta['s_id'].'">'.$sta['s_name'].'</option>';
                                                  }
                                                ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label class="col-md-12">ชื่อ</label>
                                          <div class="col-md-12">
                                              <input type="text" name="fname" class="form-control form-control-line" value="<?php echo $fname; ?>" required>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label class="col-md-12">นามสกุล</label>
                                          <div class="col-md-12">
                                              <input type="text" name="lname" class="form-control form-control-line" value="<?php echo $lname; ?>" required>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-12">
                                          <label for="mail" class="col-md-6">อีเมลล์</label>
                                          <div class="col-md-6">
                                              <input type="email" class="form-control form-control-line" name="mail" value="<?php echo $mail; ?>" required>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label class="col-md-12">เบอร์โทร</label>
                                          <div class="col-md-12">
                                              <input type="text" name="phone" class="form-control form-control-line" value="<?php echo $phone; ?>" minlength="9" maxlength="10" pattern="[0-9]*" title="กรอกได้เฉพาะตัวเลข" required>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-12">
                                          <a href="#modal-pass" data-toggle="modal" class="col-md-12">เปลี่ยนรหัสผ่าน</a>
                                      </div>
                                      <!-- Modal -->
                                      <div class="modal fade" id="modal-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modal-write">เปลี่ยนรหัสผ่าน</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body mx-auto">
                                              <div class="form-group col-md-12">
                                                  <label class="col-md-12">รหัสผ่านเก่า</label>
                                                  <div class="col-md-12">
                                                      <input type="password" name="oldpass" class="form-control form-control-line">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-12">
                                                  <label class="col-md-12">รหัสผ่านใหม่</label>
                                                  <div class="col-md-12">
                                                      <input type="password" name="newpass" class="form-control form-control-line">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-12">
                                                  <label class="col-md-12">ยืนยันรหัสผ่านใหม่</label>
                                                  <div class="col-md-12">
                                                      <input type="password" name="conpass" class="form-control form-control-line">
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                              <button type="submit" name="change_pass" class="btn btn-danger">เปลี่ยนหรัสผ่าน</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- End Modal -->
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="update" class="btn btn-success">อัพเดทโปรไฟล์</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </form>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018 Adminwrap by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

    <script type="text/javascript">
      $("#change_pic").click(function(){
        $("#select_pic").click();
      });
      //img_preview
      function readURL(input) {
        if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#show_pic').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#select_pic").change(function() {
        readURL(this);
      });
    </script>
</body>

</html>
