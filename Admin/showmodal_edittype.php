<?php
session_start();
include("../connection/connect.php");
if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}
$id = $_POST["id"];
$sql = "SELECT * FROM type WHERE t_id ='$id' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>

<head>
    <title>รายละเอียดของข้อมูล</title>
</head>

<body>
<!-- แสดดงข้อมูล quiz 0  -->
<div class="col-sm-12">
    <form action="fucntion_script/check_updateTypemodal.php?id=<?php echo $row['t_id']?>" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-_จ pr-sm-0" method="post">
        <div class="row">
            <div class="col-sm-12">
                <p class="color-ash">หมวดหมู่เอกสาร</p>
                <div class="pos-relative">
                    <input class="pr-20" type="text" name="t_name" value="<?php echo $row['t_name']; ?>">
                </div><!-- pos-relative -->
            </div><!-- col-sm-6 -->
            <div class="col-sm-12" align="right">
                <div class="pos-relative mt-10 mb-10">
                    <button class="btn btn-info" type="submit">อัพเดทข้อมูล</button>
                    <button class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close" type="button">ปิด</button>

                </div><!-- pos-relative -->
            </div><!-- col-sm-6 -->
        </div>
    </form>
</div>
</body>

</html>
