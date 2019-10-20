<?php
include("../connection/connect.php");

$strSQL = "SELECT * FROM member WHERE m_uname = '".$_SESSION['UserID']."' ";
$objQuery = mysqli_query($link,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php include "title_page.php"; ?>></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">

    <!-- Stylesheets -->

    <link href="plugin-frameworks/bootstrap.css" rel="stylesheet">
    <link href="fonts/ionicons.css" rel="stylesheet">
    <link href="common/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>

<header>
    <div class="bg-191">
        <div class="container">
            <div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">
                <ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
                    <li><a class="pl-0 pl-sm-10" href="#">About</a></li>
                    <li><a href="#">Advertise</a></li>
                    <li><a href="#">Submit Press Release</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
                    <li><a class="pl-0 pl-sm-10" href="#"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="#"><i class="ion-social-google"></i></a></li>
                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    <li><a href="#"><i class="ion-social-bitcoin"></i></a></li>
                </ul>
            </div><!-- top-menu -->
        </div><!-- container -->
    </div><!-- bg-191 -->

    <div class="container">
        <a class="logo" href="index.html"><h2>E-Document</h2></a>
        <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

        <ul class="main-menu" id="main-menu">
            <li><a href="index_user.php"><i class="active ion-document"></i> เอกสารทั้งหมด</a></li>
            
            
            <li class="drop-down"><a href="#"><i class="active ion-document"></i> จัดการเอกสาร<i class="ion-arrow-down-b"></i></a>
                <ul class="drop-down-menu drop-down-inner">
                    <li><a href="Document_acceptance.php"><i class="active ion-edit"></i> การตอบรับเอกสาร</a></li>
                    <li><a href="fromDocument.php"><i class="active ion-document"></i> แบบฟอร์มต่างๆ</a></li>
                    <li><a href="Download_Doc.php"><i class="active ion-android-download"></i> ดาวน์โหลดเอกสาร</a></li>
                </ul>
            </li>
            <li><a href="search_Doc.php"><i class="active ion-search"></i> ค้นเอกสารย้อนหลัง</a></li>
            <li class="drop-down"><a href="#"><i class="active ion-android-person"></i> <?php echo $objResult["m_uname"]; ?><i class="ion-arrow-down-b"></i></a>
                <ul class="drop-down-menu drop-down-inner">
                    <li><a href="profile_user.php"><i class="active ion-android-person"></i> บัญชีของฉัน</a></li>
                    <li><a href="fucntion_script/logout_user.php"><i class="active ion-log-out"></i> ออกจากระบ</a></li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div><!-- container -->
</header>

<!-- SCIPTS -->

<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
<script src="plugin-frameworks/tether.min.js"></script>
<script src="plugin-frameworks/bootstrap.js"></script>
<script src="common/scripts.js"></script>

</body>
</html>