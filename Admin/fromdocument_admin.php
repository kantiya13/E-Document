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

$sql = "SELECT * FROM member WHERE m_uname = '" . $_SESSION['UserID'] . "'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) == 0) {
    header("location:pages-error-404.php");
} else {
    while ($mem = mysqli_fetch_assoc($result)) {
        $status = $mem['m_status'];
        $major = $mem['m_sector'];
        $mail = $mem['m_mail'];
        $uname = $mem['m_uname'];
    }
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php include 'templateAdmin/title_page.php' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
        <a class="color-ash mt-10" href="fromdocument_admin.php">อัพโหลดแบบฟอร์ม </a>
    </div><!-- container -->
</section>
<?php
            if(isset($_POST['type'])){
                $file = basename($_FILES['upload-file']['name']);
                $path = "upload_file/".$file;
                $FileType = pathinfo($file,PATHINFO_EXTENSION);
                  if($FileType == "pdf"){
                      if(move_uploaded_file($_FILES['upload-file']['tmp_name'],$path)){
                        $sql = "INSERT INTO fromdocument(f_type,f_file,f_date,f_uname)
                        VALUES('".$_POST['type']."','".$file."',NOW(),'".$_SESSION['UserID']."')";
                         $objQuery = mysqli_query($link,$sql);
                         if (!$objQuery){
                          echo "<script type=\"text/javascript\">";
                          echo "alert(\"ไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง\");";
                          echo "window.history.back();";
                          echo "</script>";
                          exit();
                      }else {
                          echo "<script type=\"text/javascript\">";
                          echo "alert(\"สำเร็จ\");";
                          echo "window.history.back();";
                          echo "</script>";
                          exit();
                      }
                    }
                  }else{
                    echo '<script>alert("upload ได้เฉพาะ ไฟล์ .pdf เท่านั้น ");window.location.href="fromdocument_admin.php";</script>';
                  }
                
            }
            ?>

<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>อัพโหลดแบบฟอร์ม </b></h3>
                    <form id="document" method="post" enctype="multipart/form-data" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0 form-material form-horizontal">
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">

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
                        <span class="to-input col-md-12">อัพโหลดไฟล์ (.PDF)</span>
                        <div class="ml-3 col-sm-3 border py-3 mt-3">
                            <p id="p-file" class="mb-10"></p>
                            <input class="btn btn-success" id="btn-file" type="button" name="btn-file" value="อัพโหลดไฟล์">
                        </div>
                        <input id="upload-file" type="file" class="d-none" name="upload-file">
                    </div>
                    <div class="col-sm-2">
                    <input class="btn btn-info mt-3" type="button" value="บันทึก" data-toggle="modal" data-target="#modal-write">
                    </div>
                    </div>
                    
                    </form>
                </div>
            </div><!-- row -->

            <div class="card col-sm-12 mt-50">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>เอกสารแบบฟอร์ม ทั้งหมด </b></h3>
                    <table class="table table-sm ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">หมวดหมู่</th>
                                <th scope="col">ไฟล์</th>
                                <th scope="col">วันที่เพิ่มข้อมูล</th>
                                <th scope="col">เพิ่มโดย</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $strSQL = "SELECT * FROM fromdocument INNER JOIN type WHERE fromdocument.f_type = type.t_id ";
                            $objQuery = mysqli_query($link, $strSQL);
                            $total = mysqli_num_rows($objQuery);
                            while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                                
                                ?>
                                <tr>
                                    <th scope="row"><?= number_format($i); ?></th>
                                    <td><?php echo $result["t_name"]; ?></td>
                                    <td><?php echo $result["f_file"]; ?></td>
                                    <td><?php echo $result["f_date"]; ?></td>
                                    <td><?php echo $result["f_uname"]; ?></td>
                                    <td>
                                        <a href="fucntion_script/delectfromdoc_admin.php?id=<?php echo $result['f_id']; ?>" class="ml-10" style="color: red;">ลบ</a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                </div>
            </div><!-- row -->
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
        </div><!-- container -->
</section>

<?php //include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
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