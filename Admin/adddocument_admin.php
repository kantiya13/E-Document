<?php
session_start();
include("../connection/connect.php");

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}


/*if(mysqli_num_rows($result) == 0){
    header("location:pages-error-404.php");
}*/
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php include 'templateAdmin/title_page.php'?></title>
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
        <a class="color-ash mt-10" href="index.php">สร้างเอกสาร</a>
    </div><!-- container -->
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>สร้างเอกสาร</b></h3>
                    <form class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="color-ash">เลขที่บันทึก</p>
                                <div class="pos-relative">
                                    <input class="pr-20" type="text" value="00001">
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-12">
                                <p class="color-ash">เลขที่บันทึก</p>
                                <div class="row">
                                    <div class="col-sm-4 m-10">
                                        <div class="pos-relative">
                                            <button class="btn btn-success">เลือกรายชื่อ</button>
                                            <button class="btn btn-success">เลือกสาขาวิชา</button>
                                        </div><!-- pos-relative -->
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="pos-relative">

                                        </div><!-- pos-relative -->
                                    </div>
                                </div>
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-12">
                                <p class="color-ash">เรื่อง</p>
                                <div class="pos-relative">
                                    <input class="pr-20" type="text" value="" placeholder="กรุณากรอกชื่อเรื่อง">
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->

                            <div class="col-sm-9">
                                <p class="color-ash">หมวดหมู่</p>
                                <div class="pos-relative mt-10">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>หนังสืออืเล็กทรอนิกส์</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->

                            <div class="col-sm-3">
                                <p class="color-ash"></p>จัดหมวดหมู่
                                <div class="pos-relative mt-10">
                                    <button class="btn btn-success">จัดหมวดหมู่</button>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->

                            <div class="col-sm-12 mt-10">
                                <p class="color-ash">อัพโหลดไฟล์เอกสาร</p>
                                <div class="pos-relative mt-10">
                                    <input class="pr-20" type="file">
                                    <i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-12" align="right">
                                <div class="pos-relative mt-10 mb-10">
                                    <button class="btn btn-info" type="submit">บันทึก</button>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                        </div><!-- row -->
                    </form>
                </div><!-- col-md-6 -->
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
</body>
</html>