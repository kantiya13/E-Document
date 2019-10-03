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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-8 col-12 mx-auto">
                        <div class="card">
                            <div class="card-body">
                              <h3 class="text-themecolor text-center">สมัครสมาชิก</h3>
                                <center class="m-t-30">
                                  <img src="assets/images/login.png" class="img-circle" width="150" height="150" />
                                  <form method="post" class="form-horizontal form-material">
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="uname" class="col-lg-12 col-md-10 mt-3 text-left">ไอดี</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="text" id="uname" name="uname" class="form-control form-control-line">
                                              <p class="text-danger" id="p_uname"></p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="pass" class="col-lg-12 col-md-10 text-left">รหัสผ่าน</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="password" id="pass" name="pass" class="form-control form-control-line">
                                              <p class="text-danger" id="p_pass"></p>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <label for="conpass" class="col-lg-12 col-md-10 text-left">ยืนยันรหัสผ่าน</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="password" id="conpass" name="conpass" class="form-control form-control-line">
                                              <p class="text-danger" id="p_conpass"></p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="fname" class="col-lg-12 col-md-10 text-left">ชื่อ</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="text" id="fname" name="fname" class="form-control form-control-line">
                                              <p class="text-danger" id="p_fname"></p>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <label for="lname" class="col-lg-12 col-md-10 text-left">นามสกุล</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="text" id="lname" name="lname" class="form-control form-control-line">
                                              <p class="text-danger" id="p_lname"></p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="mail" class="col-lg-12 col-md-10 text-left">อีเมลล์</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="text" id="mail" name="mail" class="form-control form-control-line">
                                              <p class="text-danger" id="p_mail"></p>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <label for="phone" class="col-lg-12 col-md-10 text-left">เบอร์โทร</label>
                                          <div class="col-lg-12 col-md-10">
                                              <input type="text" id="phone" name="phone" class="form-control form-control-line">
                                              <p class="text-danger" id="p_phone"></p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="status" class="col-lg-12 col-md-10 text-left">สถานะ</label>
                                          <div class="col-lg-12 col-md-10">
                                              <select id="status" class="form-control" name="status">
                                                <option value="2">อาจารย์</option>
                                                <option value="3">บุคลากร</option>
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-6">
                                          <label for="sector" class="col-lg-12 col-md-10 text-left">ภาค</label>
                                          <div class="col-lg-12 col-md-10">
                                              <select id="sector" class="form-control" name="sector">
                                                <option>วิทยาศาสตร์</option>
                                                <option>วิทยาศาสตร์ประยุกต์</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <label for="major" class="col-lg-12 col-md-10 text-left">สาขา</label>
                                          <div class="col-lg-12 col-md-10">
                                            <select id="major" class="form-control" name="major">
                                              <?php
                                                $major = ['สาขาคณิตศาสตร์','สาขาเคมี','สาขาชีววิทยา','สาขาฟิสิกส์','สาขาเกษตรศาสตร์',
                                                          'สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ','สาขาวิทยาการคอมพิวเตอร์','สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย',
                                                          'สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร','สาขาวิทยาศาสตร์สิ่งแวดล้อม','สาขาวิชาสัตวศาสตร์','สาขาวิชาสาธารณสุขศาสตร์',
                                                          'สาขาวิชาอาหารและโภชนาการ'];
                                                $iMajor = count($major);
                                                for($i=0;$i<$iMajor;$i++){
                                                  echo '<option>'.$major[$i].'</option>';
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-12 mb-3">
                                              <input id="check" type="button" name="register" class="btn btn-primary" value="สมัครสมาชิก">
                                          </div>
                                          <a href="login.php">ย้อนกลับ</a>
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

            <!-- modal-regis -->
            <div id="modal-regis" class="modal fade bd-example-md">
              <div class="modal-dialog modal-md">
                <div class="modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">คำเตือน</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>ต้องการสมัครสมาชิกหรือไม่?</p>
                    </div>
                    <div class="modal-footer">
                      <button id="register" type="button" class="btn btn-primary this_close">ยืนยัน</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- modal-regis -->
            <div id="modal-ch" class="modal fade bd-example-md">
              <div class="modal-dialog modal-md">
                <div class="modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">คำเตือน</h5>
                      <button type="button" class="close close_reg" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>สมัครสมาชิกสำเร็จ กรุณารอการยืนยันจากแอดมิน</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close_reg" data-dismiss="modal">ปิด</button>
                    </div>
                  </div>
                </div>
              </div>
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
    <script type="text/javascript">

    //check
      function uname(){
        var uname = $("#uname").val();
        if(uname.length > 5 && uname.length < 13){
          $.ajax({
            type:'post',
            url:'insert_reg.php',
            data:{uname:uname},
            dataType:'json'
          })
          .done(function(data){
            if(data.uname == false){
              $("#p_uname").html('มีบัญชีนี้แล้ว');
            }else{
              $("#p_uname").html('');
            }
          })
        }else{
          $("#p_uname").html('ไอดีต้องมีความยาว 6-12 ตัวอักษร');
        }
      }
      function pass(){
        var pass = $("#pass").val(),
            conpass = $("#conpass").val();
        if(pass.length > 7 && pass.length < 17){
          $("#p_pass").html('');
        }else{
          $("#p_pass").html('รหัสผ่านต้องมีความยาว 8-16 ตัวอักษร');
        }
      }
      function conpass(){
        var pass = $("#pass").val(),
            conpass = $("#conpass").val();
        if(conpass == pass){
          $("#p_conpass").html('');
        }else{
          $("#p_conpass").html('รหัสผ่านไม่ตรงกัน');
        }
      }
      function fname(){
        if($("#fname").val().length > 0){
          $("#p_fname").html('');
        }else{
          $("#p_fname").html('โปรดกรอกชื่อ');
        }
      }
      function lname(){
        if($("#lname").val().length > 0){
          $("#p_lname").html('');
        }else{
          $("#p_lname").html('โปรดกรอกนามสกุล');
        }
      }
      function phone(){
        var phone = $("#phone").val();
        if(phone.match(/([0-9]{9,10})+/)){
          $.ajax({
            type:'post',
            url:'insert_reg.php',
            data:{phone:phone},
            dataType:'json'
          })
          .done(function(data){
            if(data.phone == false){
              $("#p_phone").html('มีเบอร์โทรนี้แล้ว');
            }else{
              $("#p_phone").html('');
            }
          })
        }else{
          $("#p_phone").html('ใส่ได้เฉพาะตัวเลข');
        }
      }
      function mail(){
        var mail = $("#mail").val();
        if(mail.match(/([A-Za-z0-9._-]+)@([a-z]+)([.]+)([a-z]{2,5})/)){
          $.ajax({
            type:'post',
            url:'insert_reg.php',
            data:{mail:mail},
            dataType:'json'
          })
          .done(function(data){
            if(data.mail == false){
              $("#p_mail").html('มีอีเมลล์นี้แล้ว');
            }else{
              $("#p_mail").html('');
            }
          })
        }else{
          $("#p_mail").html("รูปแบบอีเมลล์ไม่ถูกต้อง<br><i>ตัวอย่าง: example@hotmail.com</i>");
        }
      }
      $("#uname").focusout(function(){
        uname();
      })
      $("#pass").focusout(function(){
        pass();
      })
      $("#conpass").focusout(function(){
        conpass();
      })
      $("#fname").focusout(function(){
        fname();
      })
      $("#lname").focusout(function(){
        lname();
      })
      $("#phone").focusout(function(){
        phone();
      })
      $("#mail").focusout(function(){
        mail();
      })

      //btn register click
      $("#check").click(function(){
        var check = true,
            mail = $("#mail").val(),
            cuname = $("#uname").val(),
            phone = $("#phone").val();
        if($("#uname").val().length > 5 && $("#uname").val().length < 13){
          if($("#pass").val().length > 7 && $("#pass").val().length < 17){
            if($("#conpass").val() == $("#pass").val()){
              if($("#fname").val().length > 0){
                if($("#lname").val().length > 0){
                  if($("#mail").val().match(/([A-Za-z0-9._-]+)@([a-z]+)([.]+)([a-z]{2,5})/)){
                    if($("#phone").val().match(/([0-9]{9,10})+/)){
                      $.ajax({
                        type:'post',
                        url:'insert_reg.php',
                        data:{check:check,ch_uname:cuname,ch_phone:phone,ch_mail:mail},
                        dataType:'json'
                      })
                      .done(function(data){
                        if(data.check == true){
                          $("#modal-regis").modal("show");
                        }else{
                          $("#modal-regis").modal("hide");
                        }
                      })
                    }else{ phone(); }
                  }else{ mail(); }
                }else{ lname(); }
              }else{ fname(); }
            }else{ conpass(); }
          }else{ pass(); }
        }else{ uname(); }
      })

      //confirm register
      $("#register").click(function(){
        var uname = $("#uname").val(),
            pass = $("#pass").val(),
            phone = $("#phone").val(),
            mail = $("#mail").val(),
            fname = $("#fname").val(),
            lname = $("#lname").val(),
            sector = $("#sector option:selected").val(),
            major = $("#major option:selected").val(),
            status = $("#status option:selected").val(),
            register = true;
        $.ajax({
          type:'post',
          url:'insert_reg.php',
          data:{status:status,sector:sector,major:major,register:register,reg_uname:uname,reg_pass:pass,reg_phone:phone,reg_mail:mail,reg_fname:fname,reg_lname:lname},
          dataType:'json'
        })
        .done(function(data){
          if(data.insert == true){
            $("#modal-ch").modal("show");
          }else{
            $("#modal-ch").modal("hide");
          }
        })
      })

      $(".this_close").click(function(){
        $("#modal-regis").modal("hide");
      })
      $(".close_reg").click(function(){
        location.href="login.php";
      })
    </script>
</body>
</html>
<?php
  ob_end_flush();
  session_write_close();
?>
