<?php
  include("connection/connect.php");
  session_start();
  ob_start();
  $sql = "SELECT * FROM member WHERE m_uname = '".$_SESSION['uname']."'";
  $result = mysqli_query($link,$sql);
  if(mysqli_num_rows($result) == 0){
    header("location:pages-error-404.php");
  }else{
    while($mem = mysqli_fetch_assoc($result)){
      $status = $mem['m_status'];
      $major = $mem['m_sector'];
      $mail = $mem['m_mail'];
      $uname = $mem['m_uname'];
    }
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
        //form
        $sql = "SELECT s_form FROM send WHERE s_form = '".$_SESSION['uname']."'";
        $result = mysqli_query($link,$sql);
        $row = mysqli_num_rows($result);

        if($status == 1){
          $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname GROUP BY document.d_id DESC";
          $result = mysqli_query($link,$sql);
          $total = mysqli_num_rows($result);
        }else if($row > 0){
          $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname GROUP BY document.d_id DESC";
          $result = mysqli_query($link,$sql);
          $total = mysqli_num_rows($result);
        }else{
          $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname AND (send.s_to = '".$major."' OR send.s_to = '".$mail."') GROUP BY document.d_id DESC";
          $result = mysqli_query($link,$sql);
          $total = mysqli_num_rows($result);
        }
        if(isset($_POST['bookmark'])){
          $sql = "SELECT * FROM bookmark WHERE m_uname = '".$_SESSION['uname']."' AND document_id = '".$_POST['bookmark']."'";
          $result = mysqli_query($link,$sql);
          if(mysqli_num_rows($result) > 0){
            while($status = mysqli_fetch_assoc($result)){
              if($status['b_status'] == 'no'){
                $sql = "UPDATE bookmark SET b_status = 'yes' WHERE m_uname = '".$_SESSION['uname']."' AND document_id = '".$_POST['bookmark']."'";
                mysqli_query($link,$sql);
              }else{
                $sql = "DELETE FROM bookmark WHERE m_uname = '".$_SESSION['uname']."' AND document_id = '".$_POST['bookmark']."'";
                mysqli_query($link,$sql);
              }
            }
          }else{
            $sql = "INSERT INTO bookmark(m_uname,document_id,b_status) VALUES('".$_SESSION['uname']."','".$_POST['bookmark']."','yes')";
            mysqli_query($link,$sql);
          }
        }
        if(isset($_POST['trash'])){
          $sql = "DELETE FROM document WHERE d_id = '".$_POST['trash']."'";
          mysqli_query($link,$sql);
          $sql = "DELETE FROM bookmark WHERE document_id = '".$_POST['trash']."'";
          mysqli_query($link,$sql);
          $sql = "DELETE FROM send WHERE s_document = '".$_POST['trash']."'";
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
                        <h3 class="text-themecolor">เอกสาร</h3>
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
                            <h5 class="card-title">เอกสารทั้งหมด (<?php echo $total; ?>)</h5>
                            <div id="sh_document" class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message -->
                                <?php
                                  $type = [];
                                  if($status == 1){
                                    $sql = "SELECT * FROM document INNER JOIN member,bookmark,type WHERE document.t_type = type.t_id AND member.m_uname = document.m_uname AND document.d_id = bookmark.document_id AND bookmark.m_uname = '".$_SESSION['uname']."' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
                                  }else if($row > 0){
                                    $sql = "SELECT * FROM document INNER JOIN member,send,bookmark,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND document.d_id = bookmark.document_id AND bookmark.m_uname = '".$_SESSION['uname']."' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
                                  }else if($row == 0){
                                    $sql = "SELECT * FROM document INNER JOIN member,send,bookmark,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND (send.s_to = '".$major."' OR send.s_to = '".$mail."') AND document.d_id = bookmark.document_id AND bookmark.m_uname = '".$_SESSION['uname']."' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
                                  }
                                  $result = mysqli_query($link,$sql);
                                  if(mysqli_num_rows($result) > 0){
                                    $i=0;
                                    while($doc = mysqli_fetch_assoc($result)){
                                      $type[$i] = $doc['t_type'];
                                      if($i > 0){
                                        if($type[$i-1] != $doc['t_type']){
                                          echo '<p>'.$doc['t_name'].'</p>';
                                        }
                                      }else{
                                        echo '<p>'.$doc['t_name'].'</p>';
                                      }
                                      echo '<a href="javascript:void(0)" class="d-block">
                                              <i data-id="'.$doc['d_id'].'" style="font-size:18px;" ';
                                              if($doc['b_status'] == 'yes'){
                                                echo 'class="fa fa-star bookmark"';
                                              }
                                              echo '></i>
                                              <div onclick=window.location.href="detail.php?id='.$doc['d_id'].'" class="mail-contnet">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <h5 style="max-width:200px;" class="text-truncate">'.$doc['m_fname'].' '.$doc['m_lname'].'</h5>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <p style="max-width:450px;" class="text-truncate">'.$doc['d_title'].'</p>
                                                  </div>
                                                </div>
                                              </div>';
                                      if($status == '1' || $uname == $doc['m_uname']){
                                        echo '<i data-id="'.$doc['d_id'].'" style="font-size:18px;" class="fa fa-trash-o ml-3 p-1 trash"></i>
                                              <i style="font-size:18px;" class="fa fa-edit ml-3 p-1"></i>';
                                      }
                                      echo '</a>';
                                      $i++;
                                    }
                                  }

                                  if($status == 1){
                                    $sql = "SELECT * FROM document INNER JOIN member,type WHERE document.t_type = type.t_id AND member.m_uname = document.m_uname AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '".$_SESSION['uname']."') GROUP BY d_id ORDER BY t_type";
                                  }else if($row > 0){
                                    $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '".$_SESSION['uname']."') GROUP BY d_id ORDER BY t_type";
                                  }else if($row == 0){
                                    $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND (send.s_to = '".$major."' OR send.s_to = '".$mail."') AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '".$_SESSION['uname']."') GROUP BY d_id ORDER BY t_type";
                                  }
                                  $result = mysqli_query($link,$sql);
                                  if(mysqli_num_rows($result) > 0){
                                    $i=0;
                                    while($doc = mysqli_fetch_assoc($result)){
                                      $type[$i] = $doc['t_type'];
                                      if($i > 0){
                                        if($type[$i-1] != $doc['t_type']){
                                          echo '<p>'.$doc['t_name'].'</p>';
                                        }
                                      }else{
                                        echo '<p>'.$doc['t_name'].'</p>';
                                      }
                                      echo '<a href="javascript:void(0)" class="d-block">
                                              <i data-id="'.$doc['d_id'].'" style="font-size:18px;" ';
                                              echo 'class="fa fa-star-o bookmark"';
                                              echo '></i>
                                              <div onclick=window.location.href="detail.php?id='.$doc['d_id'].'"  class="mail-contnet">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <h5 style="max-width:200px;" class="text-truncate">'.$doc['m_fname'].' '.$doc['m_lname'].'</h5>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <p style="max-width:450px;" class="text-truncate">'.$doc['d_title'].'</p>
                                                  </div>
                                                </div>
                                              </div>';
                                      if($status == '1' || $uname == $doc['m_uname']){
                                        echo '<i data-id="'.$doc['d_id'].'" style="font-size:18px;" class="fa fa-trash-o ml-3 p-1 trash"></i>
                                              <i style="font-size:18px;" class="fa fa-edit ml-3 p-1"></i>';
                                      }
                                      echo '</a>';
                                      $i++;
                                    }
                                  }
                                ?>
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
    $(document).on('click','.bookmark',function(){
      var id = $(this).data('id');
      $.ajax({
        method:"post",
        url:"index.php",
        data:{bookmark:id},
        success:function(){
          window.location.href="index.php";
        }
      })
    })
    $(document).on('click','.trash',function(){
      if(confirm('ต้องการลบหรือไม่')){
        var id = $(this).data('id');
        $.ajax({
          method:"post",
          url:"index.php",
          data:{trash:id},
          success:function(){
            window.location.href="index.php";
          }
        })
      }
    })
    </script>
</body>
</html>
<?php
  ob_end_flush();
  session_write_close();
?>
