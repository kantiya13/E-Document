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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
        <a class="color-ash mt-10" href="index.php">สร้างเอกสาร </a>
    </div><!-- container -->
</section>
<?php
$id = $_GET['id'];

            if(isset($_POST['title'])){
                // $file = basename($_FILES['upload-file']['name']);
                // $path = "upload_file/".$file;
                // $success = move_uploaded_file($_FILES['upload-file']['tmp_name'],$path);
                // if($success){
                //     $sql = "UPDATE document SET d_title = '" . $_POST['title'] . "',d_detail = '" .$file. "' 
                //         ,m_uname = '" . $_SESSION['UserID'] . "',d_datenow = NOW(),t_type = '" .$_POST['type'] . "',from_user = '".$_SESSION['UserID']."' WHERE d_id ='id' ";
                //         $objQuery = mysqli_query($link, $sql);
                
                //         if (!$objQuery){
                //             echo "<script type=\"text/javascript\">";
                //             echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
                //             echo "window.history.back();";
                //             echo "</script>";
                //             exit();
                //         }else {
                //             echo "<script type=\"text/javascript\">";
                //             echo "alert(\"อัพเดทข้อมูลเรียบร้อยแล้ว\");";
                //             echo "window.history.back();";
                //             echo "</script>";
                //             exit();
                //         }
                // }else{
                //     $sql = "UPDATE document SET d_title = '" . $_POST['title'] . "',d_detail = '" .$file. "' 
                //         ,m_uname = '" . $_SESSION['UserID'] . "',d_datenow = NOW(),t_type = '" .$_POST['type'] . "',from_user = '".$_SESSION['UserID']."' WHERE d_id ='id' ";
                //         $objQuery = mysqli_query($link, $sql);
                
                //         if (!$objQuery){
                //             echo "<script type=\"text/javascript\">";
                //             echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง !!!\");";
                //             echo "window.history.back();";
                //             echo "</script>";
                //             exit();
                //         }else {
                //             echo "<script type=\"text/javascript\">";
                //             echo "alert(\"อัพเดทข้อมูลเรียบร้อยแล้ว\");";
                //             echo "window.history.back();";
                //             echo "</script>";
                //             exit();
                //         }
                // }
               
            }else {
                echo '<script>alert("เกิดข้อผิดพลาด");window.history.back()"</script>';
            }
            
            ?>
<section>
    <div class="container">
        <div class="row">
          <?php 
            $sqlss = "SELECT * FROM document WHERE d_id = '".$_REQUEST['id']."' ";
            $queryss = mysqli_query($link, $sqlss);
            $resultss=mysqli_fetch_array($queryss,MYSQLI_ASSOC);
          ?>
            <div class="card col-sm-12">
                <div class="card-body">
                <div class="col-sm-12 m-3">
                    <h3 class="mb-4"><b>แก้ไขเอกสาร</b></h3>
                    <form id="document" method="post" enctype="multipart/form-data" action="fucntion_script/check_edit_doc.php?id=<?php echo $_GET['id'] ;?>" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0 form-material form-horizontal">
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                    <div class="form-group row mx-3">
                        <label class="col-md-12">เลขที่บันทึก</label>
                        <div class="col-md-6">
                            <input type="text" value="<?php echo $resultss['d_docid']; ?>">
                        </div>
                    </div>
                    <?php 
                        $sqlForm = "SELECT * FROM `document` WHERE d_id = '".$_GET['id']."'";
                        $resultForm = mysqli_query($link,$sqlForm);
                        if(mysqli_num_rows($resultForm) > 0){
                            while($detail = mysqli_fetch_assoc($resultForm)){
                                $from = $detail['from_user'];
                                $to = $detail['to_user'];
                            }
                        }
                        ?>
                    <div class="form-group row mx-3">
                        <div class="col-md-6">
                            <label>จาก <?php echo $from; ?> ถึง <?php echo $to; ?></label>
                        </div>
                    </div>
                    
                    <div class="form-group row mx-3">
                        <label class="col-md-12">เรื่อง</label>
                        <div class="col-md-12">
                            <input class="form-control form-control-line" value="<?php echo $resultss['d_title']; ?>" type="text" name="title" required>
                        </div>
                    </div>
                    <div class="form-group row mx-3">
                        <label class="col-md-12 pt-3">หมวดหมู่</label>
                        <div class="col-sm-9 pt-3">
                            <select class="form-control" name="type">
                                <?php
                                $sql = "SELECT * FROM type";
                                $result = mysqli_query($link,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($type = mysqli_fetch_assoc($result)){
                                        echo '<option value="'.$type['t_id'].'">'.$type['t_name'].'</option>';
                                    }
                                }else{
                                    echo '<option>ยังไม่มีหมวดหมู่</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <input type="button" data-toggle="modal" data-target="#addType" class="btn btn-success" value="จัดการหมวดหมู่">
                        </div>
                    </div>
                    <div class="form-group mt-3 row mx-3">
                        <span class="to-input col-md-12">อัพโหลดไฟล์</span>
                        <div class="ml-3 col-sm-3 border py-3 mt-3">
                            <p id="p-file" class="mb-10"></p>
                            <input class="btn btn-success" id="btn-file" type="button" name="btn-file" value="อัพโหลดไฟล์">
                        </div>
                        <input id="upload-file" type="file" class="d-none" name="upload-file">
                    </div>
                    <div class="col-sm-2">
                    <input class="btn btn-info mt-3" type="submit" value="บันทึก" data-toggle="modal" data-target="#modal-write">
                    </div>
                    </div>
                    
                    </form>
                </div><!-- col-md-6 -->
                </div>
            
                <!-- End Modal -->
            </div>
            
            <!-- modal type -->
            <div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" id="1">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="fucntion_script/check_modalAddType.php"
                                      class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0"
                                      method="post">
                                    <div class="row p-10">
                                        <div class="col-sm-10">
                                            <p class="color-ash">หมวดหมู่</p>
                                            <div class="pos-relative">
                                                <input class="pr-20" align="center" name="typename" type="text"
                                                       value="">
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
                                                $objQuery = mysqli_query($link, $strSQL);
                                                while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                                                    ?>
                                                    <tbody>
                                                    <tr>
                                                        <td width="80%"><?php echo $result['t_name']; ?></td>
                                                        <td align="right">
                                                            <a href="" class="edittype" data-toggle="modal"
                                                               data-target="#edittype"
                                                               id="<?php echo $result["t_id"]; ?>"><i
                                                                        class="fas fa-edit" style="color: #5bb75b"></i></a>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='fucntion_script/check_deletetypemodal.php?id=<?php echo $result["t_id"]; ?>';}"><i
                                                                        class="fas fa-trash" style="color: #942a25"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div><!-- col-sm-6 -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
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

<!-- AutoComplete -->
<script src="assets/node_modules/jquery-ui-1.12.1.custom/jquery-ui.js"></script>


<script src='email-multiple/jquery.email.multiple.js'></script>
<script>
    // $(document).on('click', '.edittype', function () {
    //     let t_id = $(this).attr("id");
    //     if (t_id != '') {
    //         $.ajax({
    //             url: "showmodal_edittype.php",
    //             method: "POST",
    //             data: {
    //                 id: t_id
    //             },
    //             success: function (data) {
    //                 $('#showmodal_edit_types').html(data);
    //                 $('#addType').modal('hide');
    //                 $('#edittype').modal('show');
    //             }
    //         });
    //     }
    // });
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
    $('select').selectpicker();
    // $('.enter-mail-id').click()

    //toggle checkbox major
    // $("#checkbox-major").click(function(){
    //     var select = $(this).data("select");
    //     $("#select"+select).attr("checked", !$("#select"+select).attr("checked"));
    //     var getValue = $(this).html();
    //     if($("#select"+select).attr("checked")){
    //         $('.all-mail').append('<span id="remove-ids'+select+'" class="email-ids ">'+ getValue +' <span class="cancel-email">x</span></span><input name="all_mail[]" type="hidden" value="'+ getValue +'">');
    //     }else{
    //         $("#remove-ids"+select).remove();
    //     }
    // })
    $("#checkbox-major").click(function(){
        var select = $(this).data("select");
        $("#select"+select).attr("checked", !$("#select"+select).attr("checked"));
        var getValue = $(this).html();
        if($("#select"+select).attr("checked")){
            $('.all-mail').append('<input name="all_mail[]" value="'+ getValue +'">');
        }else{
            $("#remove-ids"+select).remove();
        }
    })



    //toggle checkbox name
    $(document).on('click','#checkbox-name',function(){
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
mysqli_close($link);
?>
<?php
ob_end_flush();
session_write_close();
?>
