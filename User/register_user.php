
<?php
include("../connection/connect.php");
$strSQL = "SELECT * FROM status";
$objQuery = mysqli_query($link,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <title>login User</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="caixa">
                    <h1 class="text-center txt-caixa mb-5">
                        <img src="../img/logo-transladoweb.png" alt="" width="200"/><br>
                        E-Document Register
                    </h1>
                    <hr>
                    <form class="form-signin" id="fromregister" name="fromregister"  method="POST" action="fucntion_script/Check_registerUser.php"  enctype="multipart/form-data" OnSubmit="return fncSubmit();">
                        <div class="row p-4">
                            <div class="col-lg-12 col-md-12">
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" class="formRow--input js-input" id="txtname" name="txtname" placeholder="ชื่อ" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="password" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" class="formRow--input js-input" id="txtlast" name="txtlast" placeholder="นามสกุล" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <select class="formRow--input js-input" style="height: 50px" name="txtstatus" required>
                                            <option>- สถานะ -</option>
                                            <?php
                                            if(mysqli_num_rows($objQuery) > 0){
                                                while($objResult = mysqli_fetch_assoc($objQuery)){
                                                    echo '<option value="'.$objResult['s_id'].'">'.$objResult['s_name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <select class="formRow--input js-input" style="height: 50px" name="txtsector" id="exampleFormControlSelect1" required>
                                            <option value="">- คณะ -</option>
                                            <option value="วิทยาศาสตร์และเทคโนโลยี">วิทยาศาสตร์และเทคโนโลยี</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <select class="formRow--input js-input" style="height: 50px" name="txtmajor" id="exampleFormControlSelect1" required>
                                            <option>- สาขาวิชา -</option>
                                            <option value="สาขาคณิตศาสตร์">สาขาคณิตศาสตร์</option>
                                            <option value="สาขาเคมี">สาขาเคมี</option>
                                            <option value="สาขาชีววิทยา">สาขาชีววิทยา</option>
                                            <option value="สาขาฟิสิกส์">สาขาฟิสิกส์</option>
                                            <option value="สาขาเกษตรศาสตร์">สาขาเกษตรศาสตร์</option>
                                            <option value="สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ">สาขาคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</option>
                                            <option value="สาขาวิทยาการคอมพิวเตอร์">สาขาวิทยาการคอมพิวเตอร์</option>
                                            <option value="สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย">สาขาวิทยาศาสตร์การกีฬาและการออกกำลังกาย</option>
                                            <option value="สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร">สาขาวิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                                            <option value="สาขาวิทยาศาสตร์สิ่งแวดล้อม">สาขาวิทยาศาสตร์สิ่งแวดล้อม</option>
                                            <option value="สาขาวิชาสัตวศาสตร์">สาขาวิชาสัตวศาสตร์</option>
                                            <option value="สาขาวิชาสาธารณสุขศาสตร์">สาขาวิชาสาธารณสุขศาสตร์</option>
                                            <option value="สาขาวิชาอาหารและโภชนาการ">สาขาวิชาอาหารและโภชนาการ</option>

                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="email" class="formRow--input js-input" id="txtemail" name="txtemail" placeholder="อีเมล์" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" class="formRow--input js-input" id="txtphone" name="txtphone" placeholder="เบอร์โทรศัพท์" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <input type="file" class="formRow--input js-input" id="upload-file" name="upload-file" placeholder="รูปภาพ" required>

                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" class="formRow--input js-input" id="txtusername" name="txtusername" placeholder="ชื่อผู้ใช้งาน" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="password" class="formRow--input js-input" id="txtpassword" name="txtpassword" placeholder="รหัสผ่าน" required>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="password" class="formRow--input js-input" id="txtconpassword" name="txtconpassword" placeholder="ยืนยันรหัสผ่าน" required>
                                        </label>
                                    </div>
                                </fieldset>

                            </div>
                            <div class="col-lg-5 col-md-5">
                                <button type="submit" class="vamos_mudar_um_pouco" style="background-color: #F9B500;border: 0px;height: 50px;" title="สมัครสมาชิก">สมัครสมาชิก</button>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-3 ml-2">
                                <fieldset class="formRow">
                                    <div class="formRow--item">
                                        <p style="font-size: 15px">Do you have an account? <a href="login_user.php">login </a></p st>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
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