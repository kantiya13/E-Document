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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
<?php
include 'templateAdmin/header.php';
?>
<section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
        <a class="mt-10" href="index_user.php"><i class="mr-5 ion-ios-home"></i>หน้าแรก<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="search_Doc.php">ค้นหาเอกสารย้อนหลัง </a>
    </div><!-- container -->
</section>
<?php 
ini_set('display_errors', 1);
error_reporting(~0);

$strKeyword = null;

if(isset($_POST["txtKeyword"]))
{
    $strKeyword = $_POST["txtKeyword"];
}
?>
<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">

                <div class="mt-30 pr-50 pl-50">
                    <form name="frmSearch" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <div class="row">
                    <div class="form-group col-sm-9 mb-3">
                        <input name="txtKeyword" type="text" id="txtKeyword" class="form-control" placeholder="ค้นหาด้วย ชื่อเรื่อง หรือ วันที่..."  >
                    </div>
                    <div class="col-sm-3">
                    <button  class="btn btn-info" type="submit" value="ค้นหา">ค้นหา</button>
                    </div>
                    </div>
                    </form>
                </div>
                
                
                <div class="pr-50 pl-50 mt-20">
                <table class="table">
                <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"width="250px">เรื่อง</th>
                            <th scope="col" >หมวดหมู่</th>
                            <th scope="col" >ไฟล์เอกสาร</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php 
                     $sqls = "SELECT * FROM document INNER JOIN send,type WHERE send.s_to = '".$mail."' AND document.d_id = send.s_document AND document.t_type = type.t_id AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') AND document.d_title LIKE '%".$strKeyword."' ";

                    $result = mysqli_query($link, $sqls) or die(mysqli_error());
                    while ($doc = mysqli_fetch_assoc($result)) 
                    {
                    ?>
                    <tr>
                        <th scope="row" width="50px"><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe83a;</i></th>
                        <td width="200px"><a href="showDetail_Doc.php?id=<?php echo $doc['d_id'];?>""><?php echo $doc['d_title'];?></a></td>
                        <td><?php echo $doc['t_name'];?></td>
                        <td><?php echo $doc['d_detail'];?></td>
                     </tr>   
                     <?php 
                        } 
                     ?>

                    <?php 

                     $sqls = "SELECT * FROM document INNER JOIN send,bookmark,type WHERE send.s_to = '".$mail."' AND document.d_id = send.s_document AND document.t_type = type.t_id AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "' AND document.d_title LIKE '%".$strKeyword."'";

                
                    $result = mysqli_query($link, $sqls) or die(mysqli_error());
                    while ($doc = mysqli_fetch_assoc($result)) 
                    {
                    ?>
                    <tr>
                        <th scope="row" width="50px"><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe838;</i></th>
                        <td width="200px"><a href="showDetail_Doc.php?id=<?php echo $doc['d_id'];?>""><?php echo $doc['d_title'];?></a></td>
                        <td><?php echo $doc['t_name'];?></td>
                        <td><?php echo $doc['d_detail'];?></td>
                     </tr>   
                     <?php 
                        } 
                     ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>


<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->

</body>
</html>
<?php
mysqli_close($link);
?>