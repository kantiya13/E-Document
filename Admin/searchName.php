<?php
include("../connection/connect.php");
$strName = "SELECT * FROM member WHERE m_status != '1' AND m_confirm = 'yes' AND (m_fname LIKE '%".$_POST['val']."%' OR m_fname LIKE '%".$_POST['val']."%' ESCAPE '\'') ORDER BY m_fname";
$objQueryName = mysqli_query($link,$strName);
$count = mysqli_num_rows($objQueryName);
$i=0;
if (mysqli_num_rows($objQueryName) > 0){
    while ($result = mysqli_fetch_array($objQueryName, MYSQLI_ASSOC)) {
        echo '
                                         <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="'.$result['m_uname'].'">  <strong>'.$result['m_fname'].' '.$result['m_lname'].'</strong> ('.$result['m_mail'].')
                                            </label>
                                        </div>
                                        ';
    }
}else {
    echo '
                                            <label class="form-check-label">ไม่มีข้อมูล</label>
                                        ';
}
?>