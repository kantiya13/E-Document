<?php
  include("../connection/connect.php");
  $strSQL = "SELECT * FROM status";
  $objQuery = mysqli_query($link,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>register สมัครสมาชิก</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Clean responsive bootstrap website template">
  <meta name="author" content="">
  <!-- styles -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="assets/css/docs.css" rel="stylesheet">
  <link href="assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/flexslider.css" rel="stylesheet">
  <link href="assets/css/refineslide.css" rel="stylesheet">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/animate.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/color/default.css" rel="stylesheet">

  <!-- fav and touch icons -->
  <link rel="shortcut icon" href="assets/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


  <!-- =======================================================
    Theme Name: Plato
    Theme URL: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>
<body>
  <section id="maincontent">
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="fromregister" name="fromregister"  method="post" action="function/Check_register.php" OnSubmit="return fncSubmit();">
                <span id="reauth-email" class="reauth-email"></span>
                 <input type="text" name="txtname" class="form-control" placeholder="ชื่อ" required autofocus>
                <input type="text" name="textlast" class="form-control" placeholder="นามสกุล" required>
                <div class="form-group">
                  <!-- <select class="form-control" name="status" id="exampleFormControlSelect1">
                    <option>- สถานะ -</option>
                  </select> -->
                <select class="form-control" name="txtstatus">
                  <option>- สถานะ -</option>
                  <?php
                    if(mysqli_num_rows($objQuery) > 0){
                      while($objResult = mysqli_fetch_assoc($objQuery)){
                        echo '<option value="'.$objResult['s_id'].'">'.$objResult['s_name'].'</option>';
                      }
                    }
                  ?>
                </select>
                </div>
                 <div class="form-group">
                  <select class="form-control" name="txtsector" id="exampleFormControlSelect1">
                    <option value="">- คณะ -</option>
                    <option value="วิทยาศาสตร์และเทคโนโลยี">วิทยาศาสตร์และเทคโนโลยี</option>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="txtmajor" id="exampleFormControlSelect1">
                    <option>- สาขาวิชา -</option>
                    <option value="สาขาคณิตศาสตร์">สาขาคณิตศาสตร์</option>
                    <option value="สาขาเคมี">สาขาเคมี</option>
                    <option value="สาขาชีววิทยา">สาขาชีววิทยา</option>
                    <option value="สาขาฟิสิกส์">สาขาฟิสิกส์</option>
                    <option value="สาขาเกษตรศาสตร์">สาขาเกษตรศาสตร์</option>
                    <option value="สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ">สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</option>
                    <option value="สาขาวิทยาการคอมพิวเตอร์">สาขาวิทยาการคอมพิวเตอร์</option>
                    <option value="สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย">สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย</option>
                    <option value="สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร">สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                    <option value="สาขาวิทยาศาสตร์สิ่งแวดล้อม">สาขาวิทยาศาสตร์สิ่งแวดล้อม</option>
                    <option value="สาขาวิชาสัตวศาสตร์">สาขาวิชาสัตวศาสตร์</option>
                    <option value="สาขาวิชาสาธารณสุขศาสตร์">สาขาวิชาสาธารณสุขศาสตร์</option>
                    <option value="สาขาวิชาอาหารและโภชนาการ">สาขาวิชาอาหารและโภชนาการ</option>

                  </select>
                </div>
                <input type="text" name="txtemail" class="form-control" placeholder="อีเมล์" required>
                <input type="text" name="txtphone" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                <input type="file" name="txtimg" class="form-control" style="margin-bottom: 10px;" placeholder="รูปโปรไฟล์">
                <hr/>
                <input type="text" name="txtusername" class="form-control" placeholder="ชื่อผู้ใช้งาน" required>
                <input type="password" name="txtpassword" class="form-control" placeholder="รหัสผ่าน" required>
                <input type="password" name="txtconpassword" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" style="margin-top: 25px;">สมัครสมาชิก</button>
            </form><!-- /form -->
            <a href="login.php" class="forgot-password">
                เข้าสู่ระบบ ?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
  </section>

  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/modernizr.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/google-code-prettify/prettify.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery.prettyPhoto.js"></script>
  <script src="assets/js/portfolio/jquery.quicksand.js"></script>
  <script src="assets/js/portfolio/setting.js"></script>
  <script src="assets/js/hover/jquery-hover-effect.js"></script>
  <script src="assets/js/jquery.flexslider.js"></script>
  <script src="assets/js/classie.js"></script>
  <script src="assets/js/cbpAnimatedHeader.min.js"></script>
  <script src="assets/js/jquery.refineslide.js"></script>
  <script src="assets/js/jquery.ui.totop.js"></script>

  <!-- Template Custom Javascript File -->
  <script src="assets/js/custom.js"></script>
  <script language="javascript">
    function fncSubmit()
    {
      if(document.fromregister.txtpassword.value != document.fromregister.txtconpassword.value)
        {
          alert('รหัสผ่านไม่ตรงกัน !!!');
          document.fromregister.txtconpassword.focus();
          return false;
        }

      document.fromregister.submit();
    }
</script>
</body>
<style type="text/css">
    body, html {
        height: 100%;
        background-repeat: no-repeat;
        background-color: #b5bac1;
    /*    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
    */}

    .card-container.card {
        max-width:550px;
        padding: 40px 40px;
    }

    .btn {
        font-weight: 700;
        height: 36px;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }

    /*
     * Card component
     */
    .card {
        background-color: #F7F7F7;
        /* just in case there no content*/
        padding: 20px 25px 30px;
        margin: 0 auto 25px;
        margin-top: 50px;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .profile-img-card {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    /*
     * Form styles
     */
    .profile-name-card {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin: 10px 0 0;
        min-height: 1em;
    }

    .reauth-email {
        display: block;
        color: #404040;
        line-height: 2;
        margin-bottom: 10px;
        font-size: 14px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin #inputUsername,
    .form-signin #inputPassword {
        direction: ltr;
        height: 44px;
        font-size: 16px;
    }

    .form-signin input[type=email],
    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin input[type=file],
    .form-signin select,
    .form-signin option,
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        direction: ltr;
        height: 44px;
        font-size: 16px;
        border: 1px solid;
        border-color: #e8e8e8;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-signin {
        /*background-color: #4d90fe; */
        background-color: rgb(104, 145, 162);
        /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-signin:hover,
    .btn.btn-signin:active,
    .btn.btn-signin:focus {
        background-color: rgb(12, 97, 33);
    }

    .forgot-password {
        color: rgb(104, 145, 162);
    }

    .forgot-password:hover,
    .forgot-password:active,
    .forgot-password:focus{
        color: rgb(12, 97, 33);
    }
  </style>
</html>
