<?php
session_start();
print_r($_REQUEST);
require_once "../includes/dbh.inc.php";
require_once "../includes/functions.inc.php";


$sql = "UPDATE `atten` SET firstName = '$_POST[fname]',`lastName`='$_POST[lname]',`userName`='$_POST[uname]',`password`='$_POST[pwd]',`Class`='$_POST[clas]' WHERE  id = '$_SESSION[id]' ";


$_SESSION["fname"] = $_POST['fname'];
$_SESSION["name"] = $_POST['lname'];
$_SESSION["username"] = $_POST['uname'];
$_SESSION["password"] = $_POST['pwd'];
$_SESSION["Class"] = $_POST['clas'];

mysqli_query($conn, $sql);
$conn->close();
