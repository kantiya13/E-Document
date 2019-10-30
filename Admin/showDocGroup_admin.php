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
$id = $_GET['id'];

$sql = "SELECT * FROM member WHERE m_uname = '" . $_SESSION['UserID'] . "'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) == 0) {
    header("location:login_admin.php");
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
        <a class="color-ash mt-10" href="showDocGroup_admin.php?id=<?php echo $id;?>">เอกสารทั้งหมดของ <?php echo $id;?></a>
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
                    <h3 class="mb-4"><b>เอกสารทั้งหมดของ <?php echo $id;?> </b></h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">เลขเอกสาร</th>
                            <th scope="col">เรื่อง</th>
                            <th scope="col">หมวดหมู่</th>
                            <th scope="col" width="150px">เพิ่มโดย</th>
                            <th scope="col">ส่งถึง</th>
                            <th scope="col">ส่งไปแล้ว</th>
                            <th scope="col">สถานะเข้าร่วม</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $type = [];
                        if ($status == 1) {
                            $sql = "SELECT * FROM document INNER JOIN member,type WHERE document.t_type = type.t_id AND member.m_uname = document.m_uname AND d_docid = '$id' AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') ORDER BY d_docid DESC";
                        } else if ($row > 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND d_docid = '$id' AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "') ORDER BY d_docid DESC";
                        } else if ($row == 0) {
                            $sql = "SELECT * FROM document INNER JOIN member,send,type WHERE document.t_type = type.t_id AND send.s_document = document.d_id AND send.s_form = member.m_uname AND d_docid = '$id' AND (send.s_to = '" . $major . "' OR send.s_to = '" . $mail . "') AND d_id NOT IN (SELECT document_id FROM bookmark WHERE m_uname = '" . $_SESSION['UserID'] . "')  ORDER BY d_docid DESC";
                        }
                        $result = mysqli_query($link, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
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
                            while ($doc = mysqli_fetch_assoc($result)) {

                                $date = $doc['d_date'];
                                $dateShow = duration($date,date("Y-m-d H:i:s"));
                                echo '
                                            <tr>
     
                                                <td><a href="showDetail_Doc.php?id='.$doc['d_id'].'"">' . $doc['d_docid'] . '</a></td>
                                                <td>' . $doc['d_title'] . '</td>
                                                <td>' . $doc['t_name'] . '</td>
                                                <td>' . $doc['m_fname'] . ' ' . $doc['m_lname'] . '</td>
                                                <td>' . $doc['to_user'] . '</td>
                                                <td>' . $dateShow . '</td>
                                                <td>' . $doc['join_doc'] . '</td>
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