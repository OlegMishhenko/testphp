<?php
session_start();
unset($_SESSION);
session_destroy();
session_write_close();
echo "<script>window.location.href='".$_SERVER['HTTP_REFERER']."'</script>";
die;
?>