<?php
require_once "includes/dbh.inc.php";
require_once "includes/functions.inc.php";

$sql = "UPDATE atten SET  accountstatus = '$_POST[status]'WHERE id ='$_POST[id]' ";
header("location../worked.php");
mysqli_query($conn, $sql);
$conn->close();
