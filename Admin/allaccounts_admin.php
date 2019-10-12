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
        <a class="color-ash mt-10" href="adddocument_admin.php">บัญชีทั้งหมด</a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>บัญชีทั้งหมด</b></h3>
                    <div class="table-responsive">
                        <table class="table table-sm ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">รหัสผ่าน</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">อีเมลล์</th>
                                <th scope="col">เบอร์โทรศัพท์</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">การอนุมัติ</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>
                                    <a href="accountlist_admin.php" class="mr-10" style="color: green;">แก้ไข</a>
                                    <a href="delectlist_admin.php" class="ml-10" style="color: red;">ลบ</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- col-md-6 -->
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
</body>
</html>