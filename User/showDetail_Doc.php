<?php
session_start();
ob_start();
include("../connection/connect.php");

/*if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_admin.php");
} elseif ($_SESSION["Status"] != 1) {
    header("location:login_admin.php");
}*/

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
<?php
$MonthTH = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
$sql = "SELECT * FROM document INNER JOIN member WHERE d_id = '".$_GET['id']."' AND document.m_uname = member.m_uname";
$result = mysqli_query($link,$sql);
if(mysqli_num_rows($result) > 0){
    while($detail = mysqli_fetch_assoc($result)){
        $day = date('j',strtotime($detail['d_datenow']));
        $iMonth = date('n',strtotime($detail['d_datenow']))-1;
        $year = date('Y',strtotime($detail['d_datenow']))+543;
        $title = $detail['d_title'];
        $doc = $detail['d_detail'];
        $from = $detail['m_major'];
    }
}else{
    header("location:pages-error-404.php");
}
?>
<section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
        <a class="mt-10" href="index_user.php"><i class="mr-5 ion-ios-home"></i>หน้าแรก<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="mt-10" href="index_user.php"><i class="mr-5 ion-android-document"></i>เอกสารทั้งหมด<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="">รายละเอียดเอกสาร <?php echo $_GET['id']; ?></a>
    </div><!-- container -->
</section>

<section>
    <div class="container">
        <h3 class="mb-15">รายละเอียดเอกสาร (<?php echo $_GET['id']; ?>)</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 p-40 mt">
                        <div class="mb-15">
                            <p class="card-text">เลขที่เอกสาร</p>
                            <strong><?php echo $_GET['id']; ?></strong>
                        </div>
                        <?php 
                        $sqlForm = "SELECT * FROM `document` INNER JOIN `send`  WHERE d_id = '".$_GET['id']."'";
                        $resultForm = mysqli_query($link,$sqlForm);
                        if(mysqli_num_rows($resultForm) > 0){
                            while($detail = mysqli_fetch_assoc($resultForm)){
                                $to = $detail['s_to'];
                                $from = $detail['m_uname'];
                            }
                        }
                        ?>
                        <div class="mb-15">
                            <p class="card-text ">จาก <?php echo $from; ?> ถึง <?php echo $to; ?></p>
                        </div>
                        <div class="mb-15">
                            <p class="card-text">เรื่อง</p>
                            <strong><?php echo $title; ?></strong>
                        </div>
                        <div class="mb-15">
                            <p class="card-text">รายละเอียด</p>
                            <strong><?php echo 'โพสเมื่อวันที่ '.$day.' '.$MonthTH[$iMonth].' '.$year; ?></strong>
                        </div>
                        <div class="mb-15">
                            <p class="card-text">ไฟล์</p>
                            <a href="../Admin/upload_file/<?php echo $doc; ?>" style="color: #00aeef"><strong><?php echo $doc; ?></strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

</section>

<?php //include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script type="text/javascript">

</script>
</body>
</html>