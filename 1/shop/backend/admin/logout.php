<?php
require_once '../tools.func.php';
deleteSession('admin', 'admin');
header('location:login.php');