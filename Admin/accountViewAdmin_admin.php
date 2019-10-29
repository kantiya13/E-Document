<?php
session_start();
ob_start();
include("../connection/connect.php");

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}
$User_id = $_GET["id"];
$strSQLUser = "SELECT * FROM member WHERE m_uname = '$User_id' ";
$objQueryUser = mysqli_query($link, $strSQLUser);
$objResultUSer = mysqli_fetch_array($objQueryUser, MYSQLI_ASSOC);


?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php include 'templateAdmin/title_page.php' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
</head>
<body>
<?php
include 'templateAdmin/header.php';
?>
<section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
        <a class="mt-10" href="index.php"><i class="mr-5 ion-ios-home"></i>หน้าแรก<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="alladmin_admin.php">บัญชีผู้ดูแลระบบ<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="accountViewAdmin_admin.php?id=<?php echo $result['m_uname']; ?>">ข้อมูลของผู้ดูแลระบบ</a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 550px">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="col-xs-7 m-20" align="center">
                    <img src="upload_file/<?php echo $objResultUSer['m_profile']; ?>" class="rounded-circle1"/>
                </div>
                <h3 class="mb-10" align="center"><b><?php echo $objResultUSer['m_uname'] ?></b></h3>


            </div><!-- col-md-6 -->

            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 p-40 mt">
                                <div class="mb-15">
                                    <p class="card-text">ชื่อ - นามสกุล</p>
                                    <strong><?php echo $objResultUSer['m_fname']; ?> <?php echo $objResultUSer['m_lname']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text "> เบอร์โทรศัพท์</p>
                                    <strong><?php echo $objResultUSer['m_phone']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">อีเมล์</p>
                                    <strong><?php echo $objResultUSer['m_mail']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">สถานะ</p>
                                    <strong><?php echo $objResultUSer['m_status']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">คณะ</p>
                                    <strong><?php echo $objResultUSer['m_sector']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">สาขาวิชา</p>
                                    <strong><?php echo $objResultUSer['m_major']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">ภาควิชา</p>
                                    <strong><?php echo $objResultUSer['m_Department']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">ตำแหน่งวิชาการ</p>
                                    <strong><?php echo $objResultUSer['m_academic']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">ตำแหน่งงาน</p>
                                    <strong><?php echo $objResultUSer['m_position']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">วุฒิการศึกษา</p>
                                    <strong><?php echo $objResultUSer['m_educational']; ?></strong>
                                </div>
                                <div class="mb-15">
                                    <p class="card-text">ตำแหน่งบริหาร</p>
                                    <strong><?php echo $objResultUSer['m_management']; ?></strong>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- col-md-6 -->
            <!-- The Modal change password -->

            <!-- The Modal change password -->
        </div><!-- row -->

    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script>

</script>
</body>
<style>
    .rounded-circle1 {
        border-radius: 100% !important;
        width: 150px;
        height: 150px;
    }
</style>
</html>