<?php
  session_start();
  session_destroy();
  header("location:login.php");
  session_write_close();
?>
