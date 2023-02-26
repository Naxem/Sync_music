<?php
session_destroy();
$_SESSION["auth"] = 0;
$_SESSION["id"] = 0;
header("location: login");
?>