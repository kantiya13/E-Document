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
      <?php
        $sql = "SELECT * FROM member WHERE m_status != 1";
        $result = mysqli_query($link,$sql);
        $total = mysqli_num_rows($result);
        if(isset($_POST['del'])){
          $sql = "DELETE FROM member WHERE m_uname = '".$_POST['del']."'";
          mysqli_query($link,$sql);
        }
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
                        <h3 class="text-themecolor">บัญชี</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">หน้าแรก</a></li>
                            <li class="breadcrumb-item active">รายการ</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Notification And Feeds -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Start Notification -->
                    <div class="col-12">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">บัญชีทั้งหมด (<?php echo $total; ?>)</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>ไอดี</th>
                                      <th>รหัสผ่าน</th>
                                      <th>ชื่อ - สกุล</th>
                                      <th>อีเมลล์</th>
                                      <th>เบอร์โทร</th>
                                      <th>สถานะ</th>
                                      <th>การอนุมัติ</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $sql = "SELECT * FROM member INNER JOIN status WHERE  m_status != 1 AND m_status = s_id";
                                      $result = mysqli_query($link,$sql);
                                      if(mysqli_num_rows($result) > 0){
                                        $i=1;
                                        while($member = mysqli_fetch_assoc($result)){
                                          echo '<tr>
                                                  <td>'.$i.'</td>
                                                  <td>'.$member['m_uname'].'</td>
                                                  <td>'.$member['m_pass'].'</td>
                                                  <td>'.$member['m_fname'].' '.$member['m_lname'].'</td>
                                                  <td>'.$member['m_mail'].'</td>
                                                  <td>'.$member['m_phone'].'</td>';
                                          if($member['s_name'] == 'บุคลากร'){
                                            echo '<td><span class="text-primary">'.$member['s_name'].'</span></td>';
                                          }
                                          if($member['s_name'] == 'อาจารย์'){
                                            echo '<td><span class="text-success">'.$member['s_name'].'</span></td>';
                                          }
                                          if($member['s_name'] == 'ไม่ยืนยัน'){
                                            echo '<td><span class="text-danger">'.$member['s_name'].'</span></td>';
                                          }
                                          if ($member['m_confirm'] == 'yes') {
                                              echo '<td><span class="text-success">อนุมัติแล้ว</span></td>';
                                          }
                                          if ($member['m_confirm'] == 'no') {
                                              echo '<td><span class="text-danger">ยังไม่อนุมัติ</span></td>';
                                          }
                                            
                                            echo '<td align="center"><a href="manage_list.php?id='.$member['m_uname'].'">แก้ไข</a><a class="text-danger del-user" data-id="'.$member['m_uname'].'" href="javascript:void(0)">ลบ</a></td>
                                                </tr>';
                                                $i++;
                                        }
                                      }
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Notification -->
                </div>
                <!-- ============================================================== -->
                <!-- End Notification And Feeds -->
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
    <script type="text/javascript">
      function del_user(id){
        $.ajax({
          type:'post',
          data:{del:id},
          url:'list.php'
        })
        .done(function(data){
          location.href="list.php";
        })
      }
      $(document).on('click','.del-user',function(){
        var id = $(this).data("id");
        if(confirm('ต้องการลบหรือไม่')){
          del_user(id);
        }
      })
    </script>
</body>
</html>
<?php
  ob_end_flush();
  session_write_close();
?>
