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
        <a class="color-ash mt-10" href="adddocument_admin.php">เอกสารทั้งหมด </a>
    </div><!-- container -->
</section>
<?php
//form
$sql = "SELECT s_form FROM send WHERE s_form = '".$_SESSION['UserID']."'";
$result = mysqli_query($link,$sql);
$row = mysqli_num_rows($result);

if($status == 1){
    $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname GROUP BY document.d_id DESC";
    $result = mysqli_query($link,$sql);
    $total = mysqli_num_rows($result);
}else if($row > 0){
    $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname GROUP BY document.d_id DESC";
    $result = mysqli_query($link,$sql);
    $total = mysqli_num_rows($result);
}else{
    $sql = "SELECT * FROM send INNER JOIN member,document WHERE send.s_document = document.d_id AND send.s_form = member.m_uname AND (send.s_to = '".$major."' OR send.s_to = '".$mail."') GROUP BY document.d_id DESC";
    $result = mysqli_query($link,$sql);
    $total = mysqli_num_rows($result);
}
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
if(isset($_POST['trash'])){
    $sql = "DELETE FROM document WHERE d_id = '".$_POST['trash']."'";
    mysqli_query($link,$sql);
    $sql = "DELETE FROM bookmark WHERE document_id = '".$_POST['trash']."'";
    mysqli_query($link,$sql);
    $sql = "DELETE FROM send WHERE s_document = '".$_POST['trash']."'";
    mysqli_query($link,$sql);
}
?>

<section>
    <div class="container" style="min-height: 450px">
        <div class="row">
            <div class="card col-sm-12">
                <div class="col-sm-12 col-md-12 m-3">
                    <h3 class="mb-4"><b>เอกสารทั้งหมด </b></h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">เรื่อง</th>
                            <th scope="col" width="150px">เพิ่มโดย</th>
                            <th scope="col">หมวดหมู่</th>
                            <th scope="col" width="150px">ตัวเลือก</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $type = [];
                        if ($status == 1) {
                            $sql = "SELECT * FROM document INNER JOIN  member,bookmark,type WHERE document.t_type = type.t_id AND member.m_uname = document.m_uname AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
                        } else if ($row > 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,bookmark,type WHERE document.t_type = type.t_id AND  AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
                        } else if ($row == 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,bookmark,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND document.d_id = bookmark.document_id AND bookmark.m_uname = '" . $_SESSION['UserID'] . "' AND document.m_uname = member.m_uname GROUP BY d_id ORDER BY t_type";
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
                                                <th scope="row" width="50px"><a href=""><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe838;</i></a></th>
                                                <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_title'] . '</a></td>
                                                <td>' . $doc['m_fname'] . ' ' . $doc['m_lname'] . '</td>
                                                <td>' . $doc['t_name'] . '</td>
                                                <td>
                                                    <i class="material-icons">&#xe3c9;</i>
                                                    <a href=""><i data-id="' . $doc['d_id'] . '" class="material-icons ml-1 trash">&#xe872;</i></a>
                                                </td>
                                            </tr>   
                                              ';
                                $i++;
                            }
                        }

                        if ($status == 1) {
                            $sql = "SELECT * FROM document INNER JOIN member,type WHERE document.t_type = type.t_id AND member.m_uname = document.m_uname AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') GROUP BY d_id ORDER BY t_type";
                        } else if ($row > 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') GROUP BY d_id ORDER BY t_type";
                        } else if ($row == 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND (send.s_to = '" . $major . "' OR send.s_to = '" . $mail . "') AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') GROUP BY d_id ORDER BY t_type";
                        }
                        $result = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($doc = mysqli_fetch_assoc($result)) {
                                echo '
                                            <tr>
                                                <th scope="row" width="50px"><a href=""><i class="material-icons bookmark" data-id="'.$doc['d_id'].'">&#xe83a;</i></a></th>
                                                <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_title'] . '</a></td>
                                                <td>' . $doc['m_fname'] . ' ' . $doc['m_lname'] . '</td>
                                                <td>' . $doc['t_name'] . '</td>
                                                <td align="left">
                                                    <a href="" ><i class="material-icons">&#xe3c9;</i></a>
                                                    <a href=""><i data-id="' . $doc['d_id'] . '" class="material-icons ml-1 trash">&#xe872;</i></a>
                                                </td>
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