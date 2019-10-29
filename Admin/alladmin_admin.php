<?php
session_start();
include("../connection/connect.php");

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}

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
        <a class="color-ash mt-10" href="alladmin_admin.php">บัญชีผู้ดูแลระบบทั้งหมด</a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 550px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>บัญชีผู้ดูแลระบบทั้งหมด</b> <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='addAdmin_admin.php'">เพิ่มข้อมูลผู้ดูและระบบ</button></h3>
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
                            <?php
                            $i = 1;
                            $strSQL = "SELECT * FROM member INNER JOIN status WHERE  m_status = 1 AND m_status = s_id";
                            $objQuery = mysqli_query($link, $strSQL) or die(mysqli_error($link));
//                            $total = mysqli_num_rows($objQuery);
                            while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                                if ($result["m_status"] == 1) {
                                    $status = 'แอดมิน';
                                    $color = 'text-primary';
                                }
                                if ($result["m_confirm"] == 'no'){
                                    $confirm = 'ยังไม่ได้อนุมัติ';
                                    $color = 'text-danger';
                                }
                                if ($result["m_confirm"] == 'yes'){
                                    $confirm = 'อนุมัติแล้ว';
                                    $color = 'text-success';
                                }
                                ?>
                                <tr>
                                    <th scope="row"><?= number_format($i); ?></th>
                                    <td><?php echo $result["m_uname"]; ?></td>
                                    <td><?php echo $result["m_pass"]; ?></td>
                                    <td><?php echo $result["m_fname"]; ?></td>
                                    <td><?php echo $result["m_mail"]; ?></td>
                                    <td><?php echo $result["m_phone"]; ?></td>
                                    <td class="<?php echo $color; ?>"><?php echo $status; ?></td>
                                    <td class="<?php echo $color; ?>"><?php echo $confirm; ?></td>
                                    <td>
                                        <a href="accountlistAdmin_admin.php?id=<?php echo $result['m_uname']; ?>" class="mr-10" style="color: green;">แก้ไข</a>
<!--                                        <a href="fucntion_script/delectlist_admin.php?id=--><?php //echo $result['m_uname']; ?><!--" class="ml-10" style="color: red;">ลบ</a>-->
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        mysqli_close($link);
                        ?>
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