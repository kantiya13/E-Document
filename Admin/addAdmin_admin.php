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
        <a class="color-ash mt-10" href="addAdmin_admin.php">เพิ่มข้อมูลผู้ดูและระบบ</a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 550px">
        <?php
        if(isset($_POST['txtname'])){
            $confirm = 'no';
            $file = basename($_FILES['upload-file']['name']);
            $path = "upload_file/" . $file;
            $success = move_uploaded_file($_FILES['upload-file']['tmp_name'], $path);
            if ($success) {
                $strSQL = "INSERT INTO member (m_uname, m_pass, m_fname, m_lname, m_phone, m_mail, m_profile, m_status, m_sector, m_major,m_Department,m_academic,m_position,m_educational,m_management, m_confirm)
                        VALUES ('" . $_POST["txtusername"] . "','" . $_POST["txtpassword"] . "','" . $_POST["txtname"] . "'
                        ,'" . $_POST["txtlast"] . "','" . $_POST["txtphone"] . "','" . $_POST["txtemail"] . "','".$file."','" . $_POST["txtstatus"] . "','" . $_POST["txtsector"] . "','" . $_POST["txtmajor"] . "','" . $_POST["txtDepartment"] . "','" . $_POST["txtacademic"] . "','" . $_POST["txtposition"] . "','" . $_POST["txteducational"] . "','" . $_POST["txtmanagement"] . "', '" . $confirm . "')";
                $objQuery = mysqli_query($link, $strSQL);
                if ($objQuery) {
                    echo '<script>alert("สมัครสมาชิกสำเร็จ");window.location.href="alladmin_admin.php";</script>';
                } else {
                    echo '<script>alert("สมัครสมาชิกไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง");window.location.href="addAdmin_admin.php";</script>';
                }
            }else{
                $strSQL = "INSERT INTO member (m_uname, m_pass, m_fname, m_lname, m_phone, m_mail, m_status, m_sector, m_major,m_Department,m_academic,m_position,m_educational,m_management, m_confirm)
                        VALUES ('" . $_POST["txtusername"] . "','" . $_POST["txtpassword"] . "','" . $_POST["txtname"] . "'
                        ,'" . $_POST["txtlast"] . "','" . $_POST["txtphone"] . "','" . $_POST["txtemail"] . "','" . $_POST["txtstatus"] . "','" . $_POST["txtsector"] . "','" . $_POST["txtmajor"] . "','" . $_POST["txtDepartment"] . "','" . $_POST["txtacademic"] . "','" . $_POST["txtposition"] . "','" . $_POST["txteducational"] . "','" . $_POST["txtmanagement"] . "', '" . $confirm . "')";
                $objQuery = mysqli_query($link, $strSQL);
            }



        }
        ?>
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>เพิ่มข้อมูลผู้ดูและระบบ</b></h3>
                    <div class="table-responsive">
                        <form id="document" method="post" enctype="multipart/form-data"
                              class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0 form-material form-horizontal"
                              OnSubmit="return fncSubmit();">
                            <div class="row p-4">
                                <div class="col-lg-12 col-md-12">
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" class="formRow--input js-input" id="txtname"
                                                       name="txtname" placeholder="ชื่อ" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="password" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" class="formRow--input js-input" id="txtlast"
                                                       name="txtlast" placeholder="นามสกุล" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtstatus" required>
                                                <option value="-">- สถานะ -</option>
                                                <?php
                                                $strSQL = "SELECT * FROM status WHERE s_id = 1";
                                                $objQuery = mysqli_query($link,$strSQL);

                                                while ($objResult = mysqli_fetch_array($objQuery)) {
                                                    echo '<option value="' . $objResult['s_id'] . '">' . $objResult['s_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtacademic" id="exampleFormControlSelect1" required>
                                                <option value="-">- ตำแหน่งวิชาการ -</option>
                                                <option value="ศาสตราจารย์">ศาสตราจารย์</option>
                                                <option value="ผู้ช่วยศาสตราจารย์">ผู้ช่วยศาสตราจารย์</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtposition" id="exampleFormControlSelect1" required>
                                                <option value="-">- ตำแหน่งงาน -</option>
                                                <option value="อาจารย์">อาจารย์</option>
                                                <option value="ธุรการ">ธุรการ</option>
                                            </select>
                                        </div>
                                    </fieldset>

                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtmanagement" id="exampleFormControlSelect1" required>
                                                <option value="-">- ตำแหน่งบริหาร -</option>
                                                <option value="คณบดี">คณบดี</option>
                                                <option value="รองคณบดี">รองคณบดี</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txteducational" id="exampleFormControlSelect1" required>
                                                <option value="-">- วุฒิการศึกษา -</option>
                                                <option value="ปริญญาตรรี">ปริญญาตรี</option>
                                                <option value="ปริญญาโท">ปริญญาโท</option>
                                                <option value="ปริญญาเอก">ปริญญาเอก (ดร.)</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtDepartment" id="exampleFormControlSelect1" required>
                                                <option value="-">- ภาควิชา -</option>
                                                <option value="ภาควิชาวิทยาศาสตร์ประยุกต์">ภาควิชาวิทยาศาสตร์ประยุกต์
                                                </option>
                                                <option value="ภาควิชาวิทยาศาสตร์ประยุกต์">ภาควิชาวิทยาศาสตร์ประยุกต์
                                                </option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px"
                                                    name="txtsector" id="exampleFormControlSelect1" required>
                                                <option value="-">- คณะ -</option>
                                                <option value="วิทยาศาสตร์และเทคโนโลยี">วิทยาศาสตร์และเทคโนโลยี</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <select class="formRow--input js-input" style="height: 50px" name="txtmajor"
                                                    id="exampleFormControlSelect1" required>
                                                <option value="-">- สาขาวิชา -</option>
                                                <option value="สาขาคณิตศาสตร์">สาขาคณิตศาสตร์</option>
                                                <option value="สาขาเคมี">สาขาเคมี</option>
                                                <option value="สาขาชีววิทยา">สาขาชีววิทยา</option>
                                                <option value="สาขาฟิสิกส์">สาขาฟิสิกส์</option>
                                                <option value="สาขาเกษตรศาสตร์">สาขาเกษตรศาสตร์</option>
                                                <option value="สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ">
                                                    สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ
                                                </option>
                                                <option value="สาขาวิทยาการคอมพิวเตอร์">สาขาวิทยาการคอมพิวเตอร์</option>
                                                <option value="สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย">
                                                    สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย
                                                </option>
                                                <option value="สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร">
                                                    สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร
                                                </option>
                                                <option value="สาขาวิทยาศาสตร์สิ่งแวดล้อม">สาขาวิทยาศาสตร์สิ่งแวดล้อม
                                                </option>
                                                <option value="สาขาวิชาสัตวศาสตร์">สาขาวิชาสัตวศาสตร์</option>
                                                <option value="สาขาวิชาสาธารณสุขศาสตร์">สาขาวิชาสาธารณสุขศาสตร์</option>
                                                <option value="สาขาวิชาอาหารและโภชนาการ">สาขาวิชาอาหารและโภชนาการ
                                                </option>

                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item mt-15">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="email" class="formRow--input js-input" id="txtemail"
                                                       name="txtemail" placeholder="อีเมล์" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" class="formRow--input js-input" id="txtphone"
                                                       name="txtphone" placeholder="เบอร์โทรศัพท์" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <div class="form-group mt-3 row mx-3">
                                        <span class="to-input col-md-12">อัพโหลดรูป</span>
                                        <div class=" col-sm-12 border py-3 mt-3">
                                            <p id="p-file" class="mb-10"></p>
                                            <input class="btn btn-success" id="btn-file" type="button" name="btn-file"
                                                   value="อัพโหลดไฟล์">
                                        </div>
                                        <input id="upload-file" type="file" class="d-none" name="upload-file">
                                    </div>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" class="formRow--input js-input" id="txtusername"
                                                       name="txtusername" placeholder="ชื่อผู้ใช้งาน" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="password" class="formRow--input js-input" id="txtpassword"
                                                       name="txtpassword" placeholder="รหัสผ่าน" required>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <fieldset class="formRow">
                                        <div class="formRow--item">
                                            <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="password" class="formRow--input js-input"
                                                       id="txtconpassword" name="txtconpassword"
                                                       placeholder="ยืนยันรหัสผ่าน" required>
                                            </label>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <button type="submit" id="send" class="vamos_mudar_um_pouco"
                                            style="background-color: #F9B500;border: 0px;height: 50px;"
                                            title="สมัครสมาชิก">สมัครสมาชิก
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div><!-- col-md-6 -->
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script language="javascript">
    function fncSubmit()
    {
        if(document.fromregister.txtpassword.value != document.fromregister.txtconpassword.value)
        {
            alert('รหัสผ่านไม่ตรงกัน !!!');
            document.fromregister.txtconpassword.focus();
            return false;
        }
        document.fromregister.submit();
    }

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
<style>
    .caixa {
        padding: 20px;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        margin-top: 25%;
        background-color: #fff !important;
        z-index: 99;
    }

    .formRow {
        position: relative;
        width: 100%;
        border-color: transparent;
        padding: 0;
        margin: 0;
    }

    .formRow--item {
        display: block;
        width: 100%;
    }

    .formRow--input {
        background-color: transparent;
        position: relative;
        padding: 15px 0 11px;
        width: 100%;
        outline: none;
        border-bottom: 1.5px solid rgba(0, 0, 0, .3);
        border-left: transparent;
        border-right: transparent;
        border-top: transparent;
        letter-spacing: .2px;
        font-weight: 400;
        font-size: 16px;
        resize: none;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
    }

    .formRow--input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    .formRow--input-wrapper.active .placeholder {
        top: -5px;
        background-color: transparent;
        color: rgba(0, 0, 0, .5);
        font-size: 11px;
        -webkit-transform: translateY(0);
        transform: translateY(0);
        font-family: sans-serif;
    }

    .formRow .placeholder {
        position: absolute;
        top: 50%;
        left: 10px;
        display: block;
        color: rgba(0, 0, 0, .5);
        white-space: nowrap;
        letter-spacing: .2px;
        -webkit-transition: all, .2s;
        transition: all, .2s;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-family: sans-serif;
        font-weight: 600;
        font-size: 14px;
    }

    .vamos_mudar_um_pouco {
        height: 100%;
        width: 100%;
        border-radius: 0;
        border: 2px solid rgba(0, 0, 0, .2);
        background-color: #5a667c;
        cursor: pointer;
        color: #fff;
        text-shadow: 2px 2px 10px rgba(255, 255, 255, .5);
    }
</style>

</html>