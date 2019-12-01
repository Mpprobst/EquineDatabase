<?php
require("../../assets/php/redirect_helper.php");
setcookie("equine_database", "", time()-3600);
header("Location: http://".$ip."/equine/");
?>
