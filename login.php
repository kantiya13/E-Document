<?php
  include("connection/connect.php");
  session_start();
  ob_start();
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
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper ml-0">
            <!-- ============================================================== -->

            <?php
              if(isset($_POST['login'])){
                $sql = "SELECT * FROM member WHERE m_uname = '".$_POST['uname']."' AND m_pass = '".$_POST['pass']."'";
                $result = mysqli_query($link,$sql);
                if(mysqli_num_rows($result) > 0){
                  $sql = "SELECT * FROM member WHERE m_uname = '".$_POST['uname']."' AND m_pass = '".$_POST['pass']."' AND m_confirm = 'no'";
                  $result = mysqli_query($link,$sql);
                  if(mysqli_num_rows($result) > 0){
                    echo '<script>alert("ไอดีนี้รอการอนุมัติจากแอดมิน");window.location.href="login.php";</script>';
                  }else{
                    $_SESSION['uname'] = $_POST['uname'];
                    header('location:index.php');
                  }
                }else{
                  echo '<script>alert("ไม่มีบัญชีผู้ใช้นี้");window.location.href="login.php";</script>';
                }
              }
            ?>

            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-5 col-xlg-3 col-md-7 col-sm-10 mx-auto">
                        <div class="card">
                            <div class="card-body">
                              <h3 class="text-themecolor text-center">เข้าสู่ระบบ</h3>
                                <center class="m-t-30">
                                  <input type="file" name="picture" class="d-none" accept="image/*">
                                  <img src="assets/images/login.png" class="img-circle" width="150" height="150" />
                                  <form method="post" class="form-horizontal form-material">
                                      <div class="form-group">
                                          <label for="name" class="col-lg-8 col-md-10 mt-3 text-left">ไอดี</label>
                                          <div class="col-lg-8 col-md-10">
                                              <input type="text" id="name" name="uname" class="form-control form-control-line">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="pass" class="col-lg-8 col-md-10 text-left">รหัสผ่าน</label>
                                          <div class="col-lg-8 col-md-10">
                                              <input type="password" id="pass" name="pass" class="form-control form-control-line">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-12 mb-3">
                                              <input type="submit" name="login" class="btn btn-success" value="เข้าสู่ระบบ">
                                          </div>
                                          <a href="register.php">สมัครสมาชิก</a>
                                      </div>
                                  </form>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
            </div>
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

</body>
</html>
<?php
  ob_end_flush();
  session_write_close();
?>
