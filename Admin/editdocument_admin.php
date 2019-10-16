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
        <a class="color-ash mt-10" href="editdocument_admin.php">หมวดหมู่เอกสาร </a>
    </div><!-- container -->
</section>
<section>
    <div class="container" style="min-height: 550px">
        <div class="row">
            <div class="card col-sm-12">
                <div class=" col-md-12 m-3">
                    <h3 class="mb-20">เพิ่มหมวดหมู่</h3>
                    <form action="fucntion_script/check_addtypedocument.php" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0" method="post">
                        <div class="row">
                            <div class="col-sm-10">
                                <p class="color-ash">หมวดหมู่</p>
                                <div class="pos-relative">
                                    <input class="pr-20" align="center" name="typename" type="text" value="">
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-2 mt-25" align="right">
                                <div class="pos-relative">
                                    <button class="btn btn-primary" type="submit">เพิ่มข้อมูล</button>
                                </div><!-- pos-relative -->
                            </div><!-- col-sm-6 -->
                        </div>
                    </form>
                    <h3 class="mb-20 mt-50">รายการ หมวดหมู่ทั้งหมด</h3>
                    <div class="row form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
                        <div class="col-sm-12">
                            <table class="table">
                                <?php
                                $i = 1;
                                $strSQL = "SELECT * FROM type";
                                $objQuery = mysqli_query($link, $strSQL) or die(mysqli_error());
                                while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                                ?>
                                <tbody>
                                <tr>
                                    <td width="80%"><?php echo $result['t_name'];?></td>
                                    <td align="right">
                                        <a href="" class="exampleModal" data-toggle="modal" data-target="#exampleModal" id="<?php echo $result["t_id"]; ?>"><i class="fas fa-edit" style="color: #5bb75b"></i></a>
                                        <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='fucntion_script/check_deletetype.php?id=<?php echo $result["t_id"];?>';}"><i class="fas fa-trash" style="color: #942a25"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>
                            <?php
                            mysqli_close($link);
                            ?>
                        </div><!-- col-sm-6 -->
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขหมวดหมู่</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="show_edit_types">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>

<?php include 'templateAdmin/footer.php' ?>
<!-- SCIPTS -->
<script>
$(document).on('click', '.exampleModal', function() {
      let t_id = $(this).attr("id");
      if (t_id != '') {
        $.ajax({
          url: "show_edittype.php",
          method: "POST",
          data: {
            id: t_id
          },
          success: function(data) {
            $('#show_edit_types').html(data);
            $('#exampleModal').modal('show');
          }
        });
      }
    });
</script>
</body>
</html>