<?php
session_start();

require_once "dbh.inc.php";
require_once "functions.inc.php";

//this is for admin status
if ($_SESSION["userstatus"] == "admin" && $_SESSION["accountstatus"] == "enable") {
    header("location:../adminpage.php");

    // this is for teacher status
} else if ($_SESSION["userstatus"] == "teacher" && $_SESSION["accountstatus"] == "enable") {
    header("location:../teacherpage.php");

    //this is for student status
} else if ($_SESSION["userstatus"] == "student" && $_SESSION["accountstatus"] == "enable") {
    header("location:../studentpage.php");
} else {
    header("location:../index.php?error=errorlockaccount");
}
