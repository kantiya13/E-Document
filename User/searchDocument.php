<?php
session_start();
include("../connection/connect.php");
if ($_SESSION['UserID'] == "") {
    echo "<script>alert(\"กรุณาเข้าสู่ระบบ ก่อนเข้าใช้งานระบบ\");window.location.href=\"login.php\";</script>";
    exit();
}
if ($_SESSION['Status'] == 1) {
    echo "<script>alert(\"ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง!!!\");window.location.href=\"login.php\";</script>";
    exit();
}
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
<section id="intro">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget ">
                    <h4>ค้นหาเอกสาร ย้อนหลัง</h4>
                    <form class="form-search">
                        <input placeholder="ค้นหา..." type="text" class="input-medium search-query span11" style="height: 30px;">
                        <button type="submit" class="btn btn-flat btn-color" style="height: 38px;">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="maincontent" style="height: 600px">
    <div class="container">
        <div class="row">
            <div class="span12">
                <table class="table table-hover">
                    <thead>
                        <th width="75px">ลำดับ</th>
                        <th>ชื่อเอกสาร</th>
                        <th>ประเภทเอกสาร</th>
                    </thead>
                    <tbody align="right">
                    <tr>
                        <td>1</td>
                        <td>กำหนดการกีฬาสี</td>
                        <td>หนังสือราชการ</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>การจัดตั้งโครงการอบรมสสาขาวิชาวิทยาการคอมพิวเตอร์</td>
                        <td>หนังสือราชการ</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>กำหนดการการจัดอบรมนักศึกษาปีที่ 4</td>
                        <td>หนังสือราชการ</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Footer
================================================== -->
<?php include 'template/footer.php'; ?>
</body>

</html>
