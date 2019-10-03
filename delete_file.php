<?php
  $src = $_POST['src'];
    if (file_exists($src)) {
      // Delete file.
      unlink($src);
    }
?>
