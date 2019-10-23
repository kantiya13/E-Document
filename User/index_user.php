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
    header("location:login_user.php");
} else {
    while ($mem = mysqli_fetch_assoc($result)) {
        $status = $mem['m_status'];
        $sector = $mem['m_sector'];
        $major = $mem['m_major'];
        $mail = $mem['m_mail'];
        $uname = $mem['m_uname'];
        $Depart = $mem['m_Department'];
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
        <a class="color-ash mt-10" href="adddocument_admin.php">เอกสารทั้งหมด </a>
    </div><!-- container -->
</section>
<?php 


$row = mysqli_num_rows($result);
    if(isset($_POST['bookmark'])){
        $sql = "SELECT * FROM bookmark WHERE m_uname = '".$_SESSION['UserID']."' AND document_id = '".$_POST['bookmark']."'";
        $result = mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            while($status = mysqli_fetch_assoc($result)){
                if($status['b_status'] == 'no'){
                    $sql = "UPDATE bookmark SET b_status = 'yes' WHERE m_uname = '".$_SESSION['UserID']."' AND document_id = '".$_POST['bookmark']."'";
                    mysqli_query($link,$sql);
                }else{
                    $sql = "DELETE FROM bookmark WHERE m_uname = '".$_SESSION['UserID']."' AND document_id = '".$_POST['bookmark']."'";
                    mysqli_query($link,$sql);
                }
            }
        }else{
            $sql = "INSERT INTO bookmark(m_uname,document_id,b_status) VALUES('".$_SESSION['UserID']."','".$_POST['bookmark']."','yes')";
            mysqli_query($link,$sql);
        }
    }
?>
<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>เอกสารสำคัญ </b></h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"width="250px">เรื่อง</th>
                            <th scope="col" >หมวดหมู่</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            if($status != 1){
                                $strSQL = "SELECT * FROM document INNER JOIN bookmark,type WHERE document.t_type = type.t_id AND document.to_user = '".$mail."'AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "'";
                            }
                            $result = mysqli_query($link, $strSQL);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($doc = mysqli_fetch_assoc($result)) {
                                    $type[$i] = $doc['t_type'];
                                    if($i > 0){
                                        if($type[$i-1] != $doc['t_type']){
                                            $type = $doc['t_name'];
                                        }
                                    }else{
                                        $type = $doc['t_name'];
                                    }
                                    echo '
                                                 <tr>
                                                    <th scope="row" width="50px"><a href=""><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe838;</i></a></th>
                                                    <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_title'] . '</a></td>
                                                    <td>' . $doc['t_name'] . '</td>
                                                </tr>   
                                                  ';
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                    </table>

                    <h3 class="mb-4"><b>เอกสารทั้งหมด </b></h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"width="250px">เรื่อง</th>
                            <th scope="col" >หมวดหมู่</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            if($status != 1){
                                $strSQL = "SELECT * FROM document INNER JOIN bookmark,type WHERE document.t_type = type.t_id AND document.to_user = '".$mail."'AND document.to_user = '".$major."'AND document.to_user = '".$sector."' AND document.to_user = '".$Depart."'  AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "'";
                            }
                            $result = mysqli_query($link, $strSQL);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($doc = mysqli_fetch_assoc($result)) {
                                    $type[$i] = $doc['t_type'];
                                    if($i > 0){
                                        if($type[$i-1] != $doc['t_type']){
                                            $type = $doc['t_name'];
                                        }
                                    }else{
                                        $type = $doc['t_name'];
                                    }
                                    echo '
                                                 <tr>
                                                    <th scope="row" width="50px"><a href=""><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe838;</i></a></th>
                                                    <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_title'] . '</a></td>
                                                    <td>' . $doc['t_name'] . '</td>
                                                </tr>   
                                                  ';
                                    $i++;
                                }
                            }
                            ?>
                            <?php
                            $type = [];
                            $i = 1;
                            if($status != 1){
                                $sql = "SELECT * FROM document INNER JOIN type WHERE document.t_type = type.t_id AND document.to_user = '".$mail."' AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') GROUP BY d_id ORDER BY t_type";
                            }
                            $result = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($doc = mysqli_fetch_assoc($result)) {
                                $type[$i] = $doc['t_type'];
                                if($i > 0){
                                    if($type[$i-1] != $doc['t_type']){
                                        $type = $doc['t_name'];
                                    }
                                }else{
                                    $type = $doc['t_name'];
                                }
                                echo '
                                             <tr>
                                                <th scope="row" width="50px"><a href=""><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe83a;</i></a></th>
                                                <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_title'] . '</a></td>
                                                <td>' . $doc['t_name'] . '</td>
                                            </tr>   
                                              ';
                                $i++;
                            }
                        }
                        ?>
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
            url: "index_user.php",
            data: {bookmark: id},
            success: function () {
                window.location.href = "index_user.php";
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
<?php
mysqli_close($link);
?>