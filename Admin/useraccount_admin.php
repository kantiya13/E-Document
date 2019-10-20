<?php
session_start();
include("../connection/connect.php");

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}

$strSQL = "SELECT * FROM member WHERE m_uname = '" . $_SESSION['UserID'] . "' ";
$objQuery = mysqli_query($link, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

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
        <a class="color-ash mt-10" href="useraccount_admin.php">โปรไฟล์</a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 550px">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="col-xs-7 m-20" align="center">
                    <img src="images/slider-6-450x600.jpg" class="rounded-circle1"/>
                </div>
                <h3 class="mb-20 mt-sm-50" align="center"><b><?php echo $objResult['m_uname'] ?></b></h3>


            </div><!-- col-md-6 -->

            <div class="col-sm-12 col-md-8">
                <form class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0" method="post"
                      action="fucntion_script/check_updateProfile_admin.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="color-ash">ชื่อ</p>
                            <div class="pos-relative">
                                <input class="pr-20" type="text" name="txtFname"
                                       value="<?php echo $objResult["m_fname"]; ?>">
                            </div><!-- pos-relative -->
                        </div><!-- col-sm-6 -->

                        <div class="col-sm-6">
                            <p class="color-ash">นามสกุล</p>
                            <div class="pos-relative">
                                <input class="pr-20" name="txtlname" type="text"
                                       value="<?php echo $objResult["m_lname"]; ?>">
                            </div><!-- pos-relative -->
                        </div><!-- col-sm-6 -->

                        <div class="col-sm-12">
                            <p class="color-ash">อีเมลล์</p>
                            <div class="pos-relative">
                                <input class="pr-20" name="txtEmail" type="email"
                                       value="<?php echo $objResult["m_mail"]; ?>">
                            </div><!-- pos-relative -->
                        </div><!-- col-sm-6 -->

                        <div class="col-sm-12">
                            <p class="color-ash">เบอร์โทรศัพท์</p>
                            <div class="pos-relative">
                                <input class="pr-20" name="txtPhone" type="text"
                                       value="<?php echo $objResult["m_phone"]; ?>">
                            </div><!-- pos-relative -->
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-12">
                            <a href="" style="color: #00c292" data-toggle="modal"
                               data-target="#myModal-changePassword">เปลี่ยนรหัสผ่าน</a>
                        </div><!-- col-sm-6 -->

                        <div class="col-sm-12">
                            <div class="pos-relative mt-30" align="right">
                                <button class="btn btn-primary" type="submit">อัพเดทโปรโฟล์</button>
                            </div><!-- pos-relative -->
                        </div><!-- col-sm-6 -->

                    </div><!-- row -->
                </form>
            </div><!-- col-md-6 -->
            <!-- The Modal change password -->
            <div class="modal fade" id="myModal-changePassword">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey"
                              method="post"
                              action="fucntion_script/changePassword_admin.php?user_id=<?php echo $_SESSION["UserID"]; ?>">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row p-50">
                                    <div class="col-sm-12">
                                        <p class="color-ash">รหัสผ่านเก่า</p>
                                        <div class="pos-relative">
                                            <input class="pr-20" type="password" name="txtOldPassword" value="">
                                        </div><!-- pos-relative -->
                                    </div><!-- col-sm-6 -->
                                    <div class="col-sm-12">
                                        <p class="color-ash">รหัสผ่านใหม่</p>
                                        <div class="pos-relative">
                                            <input class="pr-20" type="password" name="txtNewPassword" value="">
                                        </div><!-- pos-relative -->
                                    </div><!-- col-sm-6 -->
                                    <div class="col-sm-12">
                                        <p class="color-ash">ยืนยันรหัสผ่าน</p>
                                        <div class="pos-relative">
                                            <input class="pr-20" type="password" name="txtConPassword" value="">
                                        </div><!-- pos-relative -->
                                    </div><!-- col-sm-6 -->
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">อัพเดท</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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