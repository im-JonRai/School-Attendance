<?php
session_start();
require_once "dbh.inc.php";
require_once "functions.inc.php";



$uname = $_POST["studentuname"];
$class = $_REQUEST["class"];
$date = $_REQUEST["date"];
$teacher = $_REQUEST["teacher"];


$sql = "INSERT INTO class (teacher_id,class_name,`date`,teacher_name) VALUES ((select lastName from atten where lastName =  '{$teacher}'),'{$class}','{$date}','{$teacher}')";
$sql3 = "UPDATE atten SET Class = '{$class}' WHERE `atten`.`id` = $_SESSION[id]";


mysqli_query($conn, $sql);
mysqli_query($conn, $sql3);
$name = json_decode($uname);
foreach ($name as $value) {
    $sql2 = "UPDATE atten  SET Class = '{$class}' WHERE userName = '{$value}'";
    mysqli_query($conn, $sql2);
}




$conn->close();
