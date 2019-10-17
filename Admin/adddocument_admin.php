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
$strSQL = "SELECT * FROM member WHERE m_uname = '" . $_SESSION['UserID'] . "' ";
$objQuery = mysqli_query($link, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

$status = $objResult["m_status"];
$sector = $objResult["m_major"];
$mail = $objResult['m_mail'];
$uname = $objResult['m_uname'];
/*if(mysqli_num_rows($result) == 0){
    header("location:pages-error-404.php");
}*/
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php include 'templateAdmin/title_page.php' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- Text Editor -->
    <link href='froala_editor_3.0.0/css/froala_editor.pkgd.css' rel='stylesheet'>
    <script src='froala_editor_3.0.0/js/froala_editor.pkgd.min.js'></script>

    <!-- AutoComplete -->
    <link href='assets/node_modules/jquery-ui-1.12.1.custom/jquery-ui.css' rel='stylesheet'>

    <link href='email-multiple/email.multiple.css' rel='stylesheet'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9] -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
        <?php
        $sql = "SELECT d_id FROM document ORDER BY d_id ASC";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($doc = mysqli_fetch_assoc($result)) {
                $id = $doc['d_id'];
            }
        } else {
            $id = 000000;
        }
        ?>
        <div class="row">
            <div class="card">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>สร้างเอกสาร</b></h3>
                    <form class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="color-ash">เลขที่บันทึก</p>
                                <div class="pos-relative">
                                    <input class="pr-20" type="text" value="<?php echo sprintf("%05d", ($id + 1)); ?>"
                                           readonly>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-12">
                                <p class="color-ash">จาก : <?php if ($status == 1) {
                                        echo 'Admin';
                                    } else {
                                        echo '<i>' . $major . ' (ภาค : ' . $sector . ')</i>';
                                    } ?> ถึง :</p>
                                <div class="row">
                                    <div class="col-sm-4 m-10">
                                        <div class="pos-relative">
                                            <button data-toggle="modal" data-target="#moda-name" type="button"
                                                    class="btn btn-success">เลือกรายชื่อ</button>
                                            <button type="button" data-toggle="modal" data-target="#moda-major"
                                                    class="btn btn-success">เลือกสาขา</button>
                                        </div><!-- pos-relative -->
                                        <div class="all-mail col-sm-8">
                                            <div class="pos-relative">

                                            </div><!-- pos-relative -->
                                        </div>
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
                                        <?php
                                        $sql = "SELECT * FROM type";
                                        $result = mysqli_query($link, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($type = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $type['t_id'] . '">' . $type['t_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option>ยังไม่มีหมวดหมู่</option>';
                                        }
                                        ?>
                                    </select>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->

                            <div class="col-sm-3">
                                <p class="color-ash"></p>จัดหมวดหมู่
                                <div class="pos-relative mt-10">
                                    <button type="button" data-toggle="modal" data-target="#addType"  class="btn btn-success">จัดการหมวดหมู่</button>
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
                <!-- Modal -->
                <div class="modal fade" id="modal-write" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-write">ข้อความ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ต้องการสร้างเอกสารหรือไม่
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" id="send" name="send" class="btn btn-danger">ตกลง</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Modal -->
                <div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" id="1">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="fucntion_script/check_modalAddType.php" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0" method="post">
                                    <div class="row p-10">
                                        <div class="col-sm-10">
                                            <p class="color-ash">หมวดหมู่</p>
                                            <div class="pos-relative">
                                                <input class="pr-20" align="center" name="typename" type="text" value="">
                                            </div><!-- pos-relative -->
                                        </div><!-- col-sm-6 -->
                                        <div class="col-sm-2 mt-25" align="right">
                                            <div class="pos-relative">
                                                <button class="btn btn-primary" type="submit">เพิ่มข้อมูล</button>
                                            </div><!-- pos-relative -->
                                        </div><!-- col-sm-6 -->
                                    </div>
                                </form>
                                <h5 class="mt-20 pl-10">รายการ หมวดหมู่ทั้งหมด</h5>
                                <div class="row form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-20 pr-sm-0 p-10">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <table class="table">
                                                <?php
                                                $i = 1;
                                                $strSQL = "SELECT * FROM type ORDER BY t_id DESC";
                                                $objQuery = mysqli_query($link, $strSQL) or die(mysqli_error());
                                                while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                                                    ?>
                                                    <tbody>
                                                    <tr>
                                                        <td width="80%"><?php echo $result['t_name'];?></td>
                                                        <td align="right">
                                                            <a href="" class="edittype" data-toggle="modal" data-target="#edittype" id="<?php echo $result["t_id"]; ?>"><i class="fas fa-edit" style="color: #5bb75b"></i></a>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='fucntion_script/check_deletetypemodal.php?id=<?php echo $result["t_id"];?>';}"><i class="fas fa-trash" style="color: #942a25"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </table>
                                            <?php
                                            mysqli_close($link);
                                            ?>
                                        </div>
                                    </div><!-- col-sm-6 -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="edittype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขหมวดหมู่</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" id="2">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="showmodal_edit_types">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script src="assets/node_modules/jquery/jquery.min.js"></script>
<!-- Bootstrap popper Core JavaScript -->
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
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="assets/node_modules/raphael/raphael-min.js"></script>
<script src="assets/node_modules/morrisjs/morris.min.js"></script>
<!--c3 JavaScript -->
<script src="assets/node_modules/d3/d3.min.js"></script>
<script src="assets/node_modules/c3-master/c3.min.js"></script>
<!-- Chart JS -->
<script src="js/dashboard1.js"></script>
<script src="js/main.js"></script>
<script>
    $(document).on('click', '.edittype', function() {
        let t_id = $(this).attr("id");
        if (t_id != '') {
            $.ajax({
                url: "showmodal_edittype.php",
                method: "POST",
                data: {
                    id: t_id
                },
                success: function(data) {
                    $('#showmodal_edit_types').html(data);
                    $('#addType').modal('hide');
                    $('#edittype').modal('show');
                }
            });
        }
    });
</script>
</body>
</html>
<?php
ob_end_flush();
session_write_close();
?>
