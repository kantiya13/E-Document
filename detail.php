<?php
  include("connection/connect.php");
  session_start();
  ob_start();
  $sql = "SELECT * FROM member WHERE m_uname = '".$_SESSION['uname']."'";
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
    <link href="assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- Text Editor -->
    <link href='froala_editor_3.0.0/css/froala_editor.pkgd.css' rel='stylesheet'>
    <script src='froala_editor_3.0.0/js/froala_editor.pkgd.min.js'></script>

    <!-- Include Editor style. -->
    <link href='froala_editor_3.0.0/css/froala_editor.pkgd.css' rel='stylesheet' type='text/css' />

    <!-- Include JS file. -->
    <script type='text/javascript' src='froala_editor_3.0.0/js/froala_editor.pkgd.min.js'></script>
    <script type='text/javascript' src='froala_editor_3.0.0/js/plugins/file.min.js'></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">E Document</p>
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
                        <h3 class="text-themecolor">รายละเอียด</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">หน้าแรก</a></li>
                            <li class="breadcrumb-item">เอกสาร</li>
                            <li class="breadcrumb-item active">รายละเอียดเอกสาร</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->

                <?php
                  $MonthTH = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
                  $sql = "SELECT * FROM document INNER JOIN member WHERE d_id = '".$_GET['id']."' AND document.m_uname = member.m_uname";
                  $result = mysqli_query($link,$sql);
                  if(mysqli_num_rows($result) > 0){
                    while($detail = mysqli_fetch_assoc($result)){
                      $day = date('j',strtotime($detail['d_datenow']));
                      $iMonth = date('n',strtotime($detail['d_datenow']))-1;
                      $year = date('Y',strtotime($detail['d_datenow']))+543;
                      $title = $detail['d_title'];
                      $doc = $detail['d_detail'];
                      $from = $detail['m_major'];
                    }
                  }else{
                    header("location:pages-error-404.php");
                  }
                ?>

                <!-- Document-->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Start Document -->
                    <div class="col-12">
                        <form method="post" class="card card-body form-horizontal form-material">
                            <h5 class="card-title">รายละเอียดเอกสาร</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <div class="form-group mt-3">
                                    <label class="col-md-12">เลขที่บันทึก</label>
                                    <div class="col-md-6">
                                        <h4><?php echo $_GET['id']; ?></h4>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="col-md-12">จาก</label>
                                    <div class="col-md-6">
                                        <h4><?php echo $from; ?></h4>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="col-md-12">เรื่อง</label>
                                    <div class="col-md-6">
                                        <h4><?php echo $title; ?></h4>
                                    </div>
                                </div>
                                <label class="col-md-12">รายละเอียด</label>
                                <i class="col-md-12"><?php echo 'โพสเมื่อวันที่ '.$day.' '.$MonthTH[$iMonth].' '.$year; ?></i>
                                <div class="d-block col-md-12 mt-3">
                                  <a href="upload_file/<?php echo $doc; ?>"><?php echo $doc; ?></a>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modal-write" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modal-write">ข้อความ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ต้องการสร้างเอกสารหรือไม่
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" name="send" class="btn btn-danger">ตกลง</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                        </form>
                    </div>
                    <!-- End Document -->
                </div>
                <!-- ============================================================== -->
                <!-- End Document -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->

            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2018 Adminwrap by wrappixel.com </footer>
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
    <!-- Bootstrap popper Core JavaScript -->
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
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="assets/node_modules/raphael/raphael-min.js"></script>
    <script src="assets/node_modules/morrisjs/morris.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/node_modules/d3/d3.min.js"></script>
    <script src="assets/node_modules/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php
  ob_end_flush();
  session_write_close();
?>
