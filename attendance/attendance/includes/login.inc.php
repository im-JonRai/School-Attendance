<?php

if (isset($_POST["submit"])) {

    $username = $_POST["usernameinput"];
    $password = $_POST["passwordinput"];

    require_once "../includes/dbh.inc.php";

    require_once "../includes/functions.inc.php";


    if (emptyinputlogin($username, $password) !== false) {
        exit();
    }

    loginuser($conn, $username, $password);
} else {

    header("location:/worked.php");
    exit();
}
