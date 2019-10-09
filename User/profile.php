<?php
include("../connection/connect.php");
session_start();
if ($_SESSION['UserID'] == "") {
    echo "<script>alert(\"กรุณาเข้าสู่ระบบ ก่อนเข้าใช้งานระบบ\");window.location.href=\"../login.php\";</script>";
    exit();
}
if ($_SESSION['Status'] == 1) {
    echo "<script>alert(\"ชื่แผู้ใช้งาน หรือรัหสผ่านไม่ถูกต้อง!!!\");window.location.href=\"../login.php\";</script>";
    exit();
}
$strSQL = "SELECT * FROM member WHERE m_uname = '".$_SESSION['UserID']."' ";
$objQuery = mysqli_query($link,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php include 'template/title.php'; ?></title>
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


    <!-- =======================================================
      Theme Name: Plato
      Theme URL: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/
      Author: BootstrapMade.com
      Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>
<?php include 'template/header.php'; ?>
<section id="subintro" style="height: 65px;">
    <div class="container">
        <div class="row">
            <div class="span4">
                <h3>Profile</h3>
            </div>
            <div class="span8">
                <ul class="breadcrumb notop">
                    <li><a href="index.php">หน้าแรก</a><span class="divider">/</span></li>
                    <li class="active">โปรไฟล์</li>
                </ul>
            </div>
        </div>
    </div>

</section>
<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span4">
                            <aside>
                                <div class="widget">
                                    <div class="well" style="margin: 0px">
                                        <div class="centered e_bounce">
                                            <i class="icon-bg-light icon-circled icon-user icon-3x active"></i>
                                            <h4 style="margin-top: 15px">ผู้ใช้งาน <strong><?php echo $objResult['m_uname']?></strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="span8">
                            <aside>
                                <div class="widget">
                                    <ul class="project-detail">
                                        <li><label>ชื่อ - นามสกุล :</label> <?php echo $objResult['m_fname']?> <?php echo $objResult['m_lname']?></li>
                                        <li><label>เบอร์โทรศัพท์ :</label> <?php echo $objResult['m_phone']?></li>
                                        <li><label>อีเมล์ :</label><?php echo $objResult['m_mail']?></li>
                                        <li><label>คณะ :</label><?php echo $objResult['m_sector']?></li>
                                        <li><label>สาขาวิชา :</label><?php echo $objResult['m_major']?></li>
                                    </ul>
                                    <div align="right">
                                        <button href="" class="btn" style="margin-right: 5px" data-toggle="modal" data-target="#myModal">เปลี่ยนรหัสผ่าน</>
                                        <button href="" class="btn btn-warning">แก้ไขโปร์ไฟล์</button>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer
================================================== -->
<?php include 'template/footer.php'; ?>
</body>

</html>
