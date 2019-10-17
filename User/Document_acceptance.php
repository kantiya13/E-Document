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
        <a class="mt-10" href="index_user.php"><i class="mr-5 ion-ios-home"></i>หน้าแรก<i
                class="mlr-10 ion-chevron-right"></i></a>
        <a class="color-ash mt-10" href="index_user.php">เอกสารทั้งหมด </a>
    </div><!-- container -->
</section>

<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                    </tr>
                    <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php //include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script type="text/javascript">
    $(document).on('click', '.bookmark', function () {
        var id = $(this).data('id');
        $.ajax({
            method: "post",
            url: "index.php",
            data: {bookmark: id},
            success: function () {
                window.location.href = "index.php";
            }
        })
    })
    $(document).on('click', '.trash', function () {
        if (confirm('ต้องการลบหรือไม่')) {
            var id = $(this).data('id');
            $.ajax({
                method: "post",
                url: "index.php",
                data: {trash: id},
                success: function () {
                    window.location.href = "index.php";
                }
            })
        }
    })
</script>
</body>
</html>