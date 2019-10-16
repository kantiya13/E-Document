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
        if (isset($_POST['title'])) {
            $file = basename($_FILES['upload-file']['name']);
            $path = "upload_file/" . $file;
            $success = move_uploaded_file($_FILES['upload-file']['tmp_name'], $path);
            if ($success) {
                $sql = "INSERT INTO
                                document(d_id,d_title,d_detail,m_uname,d_datenow,t_type)
                              VALUES('" . sprintf("%05d", ($id + 1)) . "','" . $_POST['title'] . "','" . $file . "','" . $_SESSION['UserID'] . "',NOW(),'" . $_POST['type'] . "')";
                mysqli_query($link, $sql);
                $i = 0;
                if (count($_POST['all_mail']) == 0) {
                    $sql = "INSERT INTO send(s_to,s_document,s_form) VALUES('AllUser','" . sprintf("%05d", ($id + 1)) . "','" . $uname . "')";
                    mysqli_query($link, $sql);
                } else {
                    while ($i < count($_POST['all_mail'])) {
                        $sql = "INSERT INTO send(s_to,s_document,s_form) VALUES('" . $_POST['all_mail'][$i] . "','" . sprintf("%05d", ($id + 1)) . "','" . $uname . "')";
                        mysqli_query($link, $sql);
                        $i++;
                    }
                }
                echo '<script>alert("สำเร็จ");window.location.href="index.php"</script>';
            } else {
                echo '<script>alert("เกิดข้อผิดพลาด");window.location.href="adddocument_admin.php"</script>';
            }
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
                                    </div>
                                    <div class="all-mail col-sm-8">
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
                                    <button type="button" data-toggle="modal" data-target="#moda-type"
                                            class="btn btn-success">จัดการหมวดหมู่</button>
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
    <?php
    if (isset($_POST['add'])) {
        count($_POST['add_type']);
        for ($i = 0; $i < count($_POST['add_type']); $i++) {
            $sql = "SELECT * FROM type WHERE t_name = '" . $_POST['add_type'][$i] . "'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) == 0) {
                if ($_POST['add_type'][$i] != '') {
                    $sql = "INSERT INTO type(t_name) VALUES('" . $_POST['add_type'][$i] . "')";
                    mysqli_query($link, $sql);
                    echo '<script>window.location.href="write.php"</script>';
                } else {
                    echo '<script>alert("ห้ามใส่ช่องว่าง");window.location.href="adddocument_admin.php"</script>';
                }
            } else {
                echo '<script>alert("มีหมวดหมู่นี้แล้ว");window.location.href="adddocument_admin.php"</script>';
            }
        }
    }
    if (isset($_POST['del'])) {
        $sql = "DELETE FROM type WHERE t_id = '" . $_POST['del'] . "'";
        mysqli_query($link, $sql);
    }
    ?>
    <!-- modal type -->
    <div id="moda-type" class="modal fade bd-example-lg">
        <div class="modal-dialog modal-lg">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">จัดการหมวดหมู่</h5>
                    <button type="button" class="close close_reg" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">สามารถแก้ไขโดยการแก้ไขข้อความในกล่องข้อความแล้วกดยืนยันได้เลย</p>
                    <?php
                    $sql = "SELECT * FROM type";
                    $result = mysqli_query($link, $sql);
                    echo '<div class="row" id="sh_type">';
                    if (mysqli_num_rows($result) > 0) {
                        while ($type = mysqli_fetch_assoc($result)) {
                            echo '<div class="col-md-6 row">
                                  <div class="col-md-8 form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อหมวดหมู่" value="' . $type['t_name'] . '">
                                  </div>
                                  <div class="col-md-4 form-group">
                                    <input class="btn btn-outline-danger del_type" data-id="' . $type['t_id'] . '" type="button" value="ลบ">
                                  </div>
                                </div>';
                        }
                    }
                    echo '</div>';
                    echo '<input id="add_type" type="button" class="btn btn-outline-success" value="เพิ่มหมวดหมู่">';
                    ?>
                </div>
                <div class="modal-footer">
                    <input name="add" id="add" class="btn btn-success" type="submit" value="ยืนยัน">
                    <input class="btn btn-danger" type="button" data-dismiss="modal" value="ปิด">
                </div>
            </form>
        </div>
    </div>

    <!-- modal major -->
    <div id="moda-major" class="modal fade bd-example-md">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เลือกสาขา</h5>
                    <button type="button" class="close close_reg" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="checkbox-major" class="col-md-12">
                        <?php
                        $major = ['สาขาคณิตศาสตร์', 'สาขาเคมี', 'สาขาชีววิทยา', 'สาขาฟิสิกส์', 'สาขาเกษตรศาสตร์',
                            'สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ', 'สาขาวิทยาการคอมพิวเตอร์', 'สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย',
                            'สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร', 'สาขาวิทยาศาสตร์สิ่งแวดล้อม', 'สาขาวิชาสัตวศาสตร์', 'สาขาวิชาสาธารณสุขศาสตร์',
                            'สาขาวิชาอาหารและโภชนาการ'];
                        $iMajor = count($major);
                        for ($i = 0; $i < $iMajor; $i++) {
                            echo '<div class="d-block">
                                  <input class="filled-in" type="checkbox" id="select' . $i . '" value="' . $major[$i] . '">
                                  <label data-select="' . $i . '">' . $major[$i] . '</label>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="select-major" id="select-major" class="btn btn-success" type="button"
                           data-dismiss="modal" value="ยืนยัน">
                </div>
            </div>
        </div>
    </div>
    <!-- modal name -->
    <div id="moda-name" class="modal fade bd-example-md">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เลือกรายชื่อ</h5>
                    <button type="button" class="close close_reg" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-horizontal form-material">
                    <div id="checkbox-name" class="col-md-12">
                        <div class="form-group row mx-auto">
                            <div class="col-12">
                                <input onkeyup="search_name()" id="search-name" type="text" name="search-name"
                                       class="form-control form-control-line" placeholder="ค้นหา">
                            </div>
                        </div>
                        <div id="sh_searchName">
                            <?php
                            $sql = "SELECT * FROM member WHERE m_status != '1' AND m_confirm = 'yes' ORDER BY m_fname";
                            $result = mysqli_query($link, $sql);
                            $count = mysqli_num_rows($result);
                            $i = 0;
                            if (mysqli_num_rows($result) > 0) {
                                while ($mem = mysqli_fetch_assoc($result)) {
                                    echo '<div class="d-block mb-2">
                                    <input class="filled-in" type="checkbox" id="name' . $i . '" value="' . $mem['m_mail'] . '">
                                    <label data-select="' . $i . '" data-mail="' . $mem['m_mail'] . '">' . $mem['m_fname'] . ' ' . $mem['m_lname'] . '</label>
                                    <label><i style="font-size:12px;"> (' . $mem['m_mail'] . ')</i></label>
                                  </div>';
                                    $i++;
                                }
                            } else {
                                echo '<div class="d-block">
                                    <label>ไม่มีรายชื่อ</label>
                                  </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="select-major" id="select-major" class="btn btn-success" type="button"
                           data-dismiss="modal" value="ยืนยัน">
                </div>
            </div>
        </div>
    </div>
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
<script type="text/javascript">
    $("#upload-file").change(function(){
        $("#p-file").text($(this).val().replace(/\\/g,'/').replace(/.*\//, ''));
    })

    //uploadfileclick
    $("#btn-file").click(function(){
        $("#upload-file").click();
    })

    $("#send").click(function(){
        $('form#document').submit();
    })
    $("#add_type").click(function(){
        $("#sh_type").append('<div class="col-md-6 row"><div class="col-md-8 form-group"><input name="add_type[]" type="text" class="form-control add_type" placeholder="ชื่อหมวดหมู่"></div></div>');
    });
    $(document).on("click",".del_type",function(){
        var del = $(this).data('id');
        if(confirm("ต้องการลบหรือไม่")){
            deltype(del);
        }
    })
    function deltype(id){
        $.ajax({
            type:'post',
            url:'write.php',
            data:{del:id}
        })
            .done(function(data){
                location.href="write.php";
            })
    }

    // $("#to").keyup(function(){
    //   var input = $("#to").val();
    //   var availableTags = [];
    //   $.ajax({
    //     type:'post',
    //     url:'input.php',
    //     data:{input:input}
    //   })
    //   .done(function(data){
    //     availableTags = data.split('|');
    //     $( "#to" ).autocomplete({
    //       source: availableTags
    //     });
    //   })
    // })

    $(".enter-mail-id").keyup(function (e) {
        if (e.keyCode == 13 || e.keyCode == 32) {
            //alert('You Press enter');
            var getValue = $(this).val();
            if(getValue != ''){
                $('.all-mail').append('<span class="email-ids">'+ getValue +' <span class="cancel-email">x</span></span><input name="all_mail[]" type="hidden" value="'+ getValue +'">');
                $(this).val('');
            }
        }
    });
    $(".enter-mail-id").focusout(function (e) {
        var getValue = $(this).val();
        if(getValue != ''){
            $('.all-mail').append('<span class="email-ids">'+ getValue +' <span class="cancel-email">x</span></span><input name="all_mail[]" type="hidden" value="'+ getValue +'">');
            $(this).val('');
        }
    });
    /// Cancel
    $(document).on('click','.cancel-email',function(){
        $(this).parent().remove();
    });
    // $('.enter-mail-id').click()

    //toggle checkbox major
    $("#checkbox-major label").click(function(){
        var select = $(this).data("select");
        $("#select"+select).attr("checked", !$("#select"+select).attr("checked"));
        var getValue = $(this).html();
        if($("#select"+select).attr("checked")){
            $('.all-mail').append('<span id="remove-ids'+select+'" class="email-ids">'+ getValue +' <span class="cancel-email">x</span></span><input name="all_mail[]" type="hidden" value="'+ getValue +'">');
        }else{
            $("#remove-ids"+select).remove();
        }
    })


    //toggle checkbox name
    $(document).on('click','#checkbox-name label',function(){
        var select = $(this).data("select");
        $("#name"+select).attr("checked", !$("#name"+select).attr("checked"));
        var getValue = $(this).html();
        var getMail = $(this).data('mail');
        if($("#name"+select).attr("checked")){
            $('.all-mail').append('<span id="remove-ids'+select+'" class="email-ids">'+ getValue +' <span class="cancel-email">x</span></span><input name="all_mail[]" type="hidden" value="'+ getMail +'">');
        }else{
            $("#remove-ids"+select).remove();
        }
    })


    // search_name
    function search_name(){
        var val = $("#search-name").val();
        $.ajax({
            type:'post',
            url:'searchName.php',
            data:{val:val}
        })
            .done(function(data){
                $("#sh_searchName").html(data);
            })
    }


</script>
</body>
</html>
<?php
ob_end_flush();
session_write_close();
?>
