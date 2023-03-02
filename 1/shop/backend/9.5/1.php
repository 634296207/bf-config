<?php
$mysqli = new Mysqli("localhost","root","root","shop");
$mysqli->connect_errno;
$mysqli->connect_error;
$mysqli->set_charset("utf8");

$sql = " select * from admin ";

$res = $mysqli->query($sql);
$mysqli->connect_errno;
$mysqli->connect_error;
