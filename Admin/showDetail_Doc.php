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
    function duration($begin,$end){
        $remain=intval(strtotime($begin)-strtotime($end));
        $wan=floor($remain/86400);
        $l_wan=$remain%86400;
        $hour=floor($l_wan/3600);
        $l_hour=$l_wan%3600;
        $minute=floor($l_hour/60);
        $second=$l_hour%60;
        return $wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
    }

    while($detail = mysqli_fetch_assoc($result)){
        $day = date('j',strtotime($detail['d_datenow']));
        $iMonth = date('n',strtotime($detail['d_datenow']))-1;
        $year = date('Y',strtotime($detail['d_datenow']))+543;
        $title = $detail['d_title'];
        $doc = $detail['d_detail'];
        $from = $detail['m_major'];
        $iddoc = $detail['d_docid'];
        $d_to = $detail['d_to'];
        $note = $detail['d_note'];
        $date = $detail['d_date'];
        $dateShow = duration($date,date("Y-m-d H:i:s"));

    }
}else{
    header("location:pages-error-404.php");
}
?>
<section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
        <a class="mt-10" href="index.php"><i class="mr-5 ion-ios-home"></i>หน้าแรก<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="mt-10" href="index.php"><i class="mr-5 ion-android-document"></i>เอกสารทั้งหมด<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="">รายละเอียดเอกสาร <?php echo $iddoc; ?></a>
    </div><!-- container -->
</section>

<section>
    <div class="container">
        <h3 class="mb-15">รายละเอียดเอกสาร (<?php echo $iddoc; ?>)</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 p-40 mt">
                        <div class="mb-15">
                            <p class="card-text">เลขที่เอกสาร</p>
                            <strong><?php echo $iddoc; ?></strong>
                        </div>
                        <?php 
                        $sqlForm = "SELECT * FROM `document` WHERE d_id = '".$_GET['id']."'";
                        $resultForm = mysqli_query($link,$sqlForm);
                        if(mysqli_num_rows($resultForm) > 0){
                            while($detail = mysqli_fetch_assoc($resultForm)){
                                $from = $detail['from_user'];
                                $to = $detail['to_user'];
                                $statusDoc = $detail['join_doc'];
                            }
                        }


                        ?>
                        <div class="mb-15">
                            <p class="card-text ">จาก <?php echo $from; ?> ถึง <?php echo $to; ?></p>
                        </div>
                        <div class="mb-15">
                            <p class="card-text ">เรียน</p>
                            <strong><?php echo $d_to; ?></strong>
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
                            <a href="upload_file/<?php echo $doc; ?>" style="color: #00aeef"><strong><?php echo $doc; ?></strong></a>
                        </div>
                        <div class="mb-15">
                            <p class="card-text ">หมายเหตุ</p>
                            <strong><?php echo $note; ?></strong>
                        </div>

                        <div class="mb-15">
                            <p class="card-text">สถานะการเข้าร่วม</p>
                            <?php if($statusDoc == 'เข้าร่วม'){ ?>
                                <p style="color: #16EF3F;"><strong>เข้าร่วมแล้ว</strong></p>
                            <?php }elseif($statusDoc == 'ยืนยันการเข้าร่วม'){?>
                                <p style="color: #EF2C14;"><strong>ยังไม่ได้เข้าร่วม</strong></p>
                            <?php } ?>
                        </div>
                        <div class="mb-15">
                            <p class="card-text" style="font-size: 12px">ส่งไปเมื่อ <?php echo $dateShow; ?></p>
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