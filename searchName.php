<?php
	include("connection/connect.php");
	$sql = "SELECT * FROM member WHERE m_status != '1' AND m_confirm = 'yes' AND (m_fname LIKE '%".$_POST['val']."%' OR m_fname LIKE '%".$_POST['val']."%' ESCAPE '\'') ORDER BY m_fname";
	$result = mysqli_query($link,$sql);
	$count = mysqli_num_rows($result);
	$i=0;
	if(mysqli_num_rows($result) > 0){
	  while($mem = mysqli_fetch_assoc($result)){
	    echo '<div class="d-block">
	            <input class="filled-in" type="checkbox" id="name'.$i.'" value="'.$mem['m_mail'].'">
	            <label data-select="'.$i.'">'.$mem['m_fname'].' '.$mem['m_lname'].'</label>
	            <label><i style="font-size:12px;"> ('.$mem['m_mail'].')</i></label>
	          </div>';
	        $i++;
	  }
	}else{
	  echo '<div class="d-block">
	            <label>ไม่มีรายชื่อ</label>
	          </div>';
	}
?>