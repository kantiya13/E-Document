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
        <a class="color-ash mt-10" href="adddocument_admin.php">เอกสารทั้งหมด </a>
    </div><!-- container -->
</section>


<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>เอกสารทั้งหมด ()</b></h3>
                    <table class="table table-sm table-hover">
                        <?php
                        $strSQL = "SELECT * FROM member WHERE m_uname = '" . $_SESSION['UserID'] . "' ";
                        $objQuery = mysqli_query($link, $strSQL);
                        while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                            ?>
                            <tbody>
                            <tr>
                                <th scope="row"><a href="javascript:void(0)" class="ion-android-star-outline"></a>
                                </th>
                                <td></td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
</body>
</html>