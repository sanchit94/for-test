<?php
session_start();

$_SESSION['user'] = "";

session_destroy();

header("location:index.php");
?>