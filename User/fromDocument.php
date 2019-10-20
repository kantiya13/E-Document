<?php
session_start();
ob_start();
include("../connection/connect.php");

if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] == '';
    header("location:login_user.php");
} elseif ($_SESSION["Status"] == 1) {
    header("location:login_user.php");
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
        <a class="color-ash mt-10" href="fromDownload.php">แบบฟอร์ม ต่างๆ </a>
    </div><!-- container -->
</section>
<section>
    <div class="container" style="min-height: 450px">
    <div class="row">
      <?php 
      $strSQL = "SELECT * FROM fromdocument INNER JOIN type WHERE fromdocument.f_type = type.t_id ";
      $objQuery = mysqli_query($link, $strSQL);
      $total = mysqli_num_rows($objQuery);
      while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
          
      ?>
      <div class="col-sm-4 mt-3">
        <a href="../Admin/upload_file/<?php echo $result['f_file'] ?>" title="ดาวน์โหลดเอกสาร">
        <div class="card">
          <div class="card-body p-20">
            <p class="card-text"><i class="material-icons" style="color:crimson">&#xe415;</i> <?php echo $result['f_file'] ?></p>
          </div>
        </div>
        </a>
      </div>
      
      <?php
      }
      ?>
    </div>
        </div><!-- container -->
</section>

<?php //include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script type="text/javascript">
    
</script>
</body>
</html>
<?php
mysqli_close($link);
?>