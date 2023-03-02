<?php
require_once "../tools.func.php";
deleteSession('user','shop');
deleteSession('cart','shop');
echo "<script>history.go(-1);</script>";