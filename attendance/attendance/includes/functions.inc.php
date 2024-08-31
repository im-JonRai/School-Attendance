<?php
//check if there is any empty input


function emptyinputlogin($username, $password)
{

    $result = false;

    if (empty($username) || empty($password)) {

        $result = true;
    } else {

        $result = false;
    }
    return $result;
}

//logs the user into their account
function loginuser($conn, $username, $password)
{

    $userexist = UsernameExist(
        $conn,
        $username
    );

    if ($userexist === false) {
        header("location:../index.php?error=errorusername");
        exit();
    }

    $pwdHashed = password_hash($userexist["password"], PASSWORD_DEFAULT);
    $checkpwd = password_verify($password, $pwdHashed);

    if ($checkpwd === false) {

        header("location:../index.php?error=errorpassword");
    } else if ($checkpwd === true) {


        header("location:../includes/permission.inc.php");


        session_start();
        $_SESSION["username"] = $userexist["userName"];
        $_SESSION["userstatus"] = $userexist["status"];
        $_SESSION["name"] = $userexist["lastName"];
        $_SESSION["accountstatus"] = $userexist["accountstatus"];
        $_SESSION["id"] = $userexist["id"];
        $_SESSION["fname"] = $userexist["firstName"];
        $_SESSION["password"] = $userexist["password"];
        $_SESSION["Class"] = $userexist["Class"];
        $_SESSION["profile_picture"] = $userexist["profile_picture"];
        $_SESSION["sickcert"] = $userexist["sickcert"];
        //change

        exit();
    }
}

//check if the user exist inside the database or not (for username)
function usernameExist($conn, $username)
{

    $sql = "SELECT * FROM atten WHERE userName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username); //error handler
    mysqli_stmt_execute($stmt); // error handler

    $resultData = mysqli_stmt_get_result($stmt); //error handler

    if ($row = mysqli_fetch_assoc($resultData)) { // fetch the data from database as a arry

        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // last error handler
}

// sign up part !!!!!!==================================

//create account and insert into database
function createuser($conn, $firstName, $lastName, $username, $password, $status, $picture)
{
    $userexist = signupcheckuname($conn, $username);
    if ($userexist !== false) {
        header("location:../adminpage.php?error=errorusername");
        exit();
    } else {

        $sql = "INSERT INTO atten(firstName, lastName, userName, password,  status,accountstatus, Class,profile_picture) VALUES (?,?,?,?,?,'enable','N/A',?);";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../failedtest.php");
            exit();
        }



        mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $username, $password, $status, $picture); //error handler
        mysqli_stmt_execute($stmt); // error handler
        mysqli_stmt_close($stmt);

        header("location:../adminpage.php?success=successfulcreated");

        exit();
    }
}

//emptyinputsignup
function emptysignup($firstName, $lastName, $username, $password, $status)
{
    $res = false;

    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($status)) {

        $res = true;
    } else {

        $res = false;
    }
    return $res;
}

// this is for signup to check username is already exits or havent in order to create new user
function signupcheckuname($conn, $username)
{

    $sql = "SELECT * FROM atten WHERE userName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username); //error handler
    mysqli_stmt_execute($stmt); // error handler


    $resultData = mysqli_stmt_get_result($stmt); //error handler

    if ($row = mysqli_fetch_assoc($resultData)) { // fetch the data from database as a arry
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // last error handler
}
