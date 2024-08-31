<?php
session_start();
print_r($_REQUEST);
require_once "../includes/dbh.inc.php";
require_once "../includes/functions.inc.php";


$sql = "UPDATE `atten` SET `Class` = 'N/A' WHERE `atten`.`id` = $_POST[studentid];";


mysqli_query($conn, $sql);
$conn->close();
