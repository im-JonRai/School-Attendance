<?php session_start(); ?>
<?php include 'html/tools.html'; ?>
<!DOCTYPE html>

<head>
    <?php
    require_once "includes/dbh.inc.php";
    require_once "includes/functions.inc.php";
    ?>
    <script>
        $("document").ready(function() {
            $(".bg-modal").hide();


            $("#Search").click(function() {
                document.location.href = 'adminSearch.php';
            });


            $("#sick").click(function() {
                document.location.href = 'adminsick.php';
            });

            $("#curryear").click(function() {
                document.location.href = 'admincurrreport.php';
            });


            $("#previous").click(function() {
                document.location.href = 'adminpreviousreport.php';
            });

        });


            $("document").ready(function() {
            $("#createbtn").click(function() {
                $(".bg-modal").show();
            });
        });

        $("document").ready(function() {
            $(".signupclosebtn").click(function() {
                $(".bg-modal").hide();

            });
            $("document").ready(function() {
                $(".success").hide();
            });
        });
        $("document").ready(function() {
            $("#alluser").click(function() {
                $(".fetch").show();
            });
        });



        $("document").ready(function() {
            $("#alluser").click(function() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost/attendance/includes/viewuser.inc.php",
                    success: function(data) {
                        $(".fetch").html(data);
                    }
                })
            })
        });
    </script>
</head>


<body>

    <div class="mainbody">
        <ul>
            <li><button id="createbtn" name=button> Create User </button></li>
            <li><button id="Search" name=button> Search </button></li>
            <li><button id="alluser" name=alluserbutton> View All Users !</button></li>
            <li><button id="sick" name=button> sick </button></li>
            <li><button id="curryear" name=button> current year </button></li>
            <li><button id="previous" name=button> previous year </button></li>


            <li>
                <button>
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                </button>
            </li>
        </ul>
        <div class="mainpage">
            <div class="welcomemessage">
                <?php
                print_r("Welcome " . $_SESSION["name"] . " ! Your Stats is  " .  $_SESSION["userstatus"]);
                ?>
            </div>
            <div class="content">
                <table style="color:white;width:100%">
                    <div class="fetch"></div>
                </table>
            </div>
        </div>
    </div>

    <style>
        table,
        th,
        td {

            border: 1px solid white;
        }

        .mainpage {
            width: 100%;
            padding: 1px 16px;
        }

        .sbtn {
            color: green;
        }

        li button {
            color: white;
            border: solid 1px black;
            background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            width: 198px;
        }

        .mainbody {
            display: inline-flex;
            color: white;
            background-color: #222D32;
            height: 100%;
            width: 100%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 200px;
            height: 100%;
            background-color: #27EF9F;
        }
    </style>

    <div class="bg-modal">
        <form class="signup" id="signup" action="includes/signup.inc.php" method="POST" enctype="multipart/form-data">
            <div class="head">
                <h2>
                    Add New User
                </h2>
                <label id="messagebox" style="color: red; font-size:small;"></label>
            </div>
            <div>
                <p>

                    <input name="username" placeholder="Username" required></input>
                </p>

                <p>
                    <input name="password" placeholder="Password" value="password123" required></input>
                </p>

                <p>
                    <input name="firstName" placeholder="First Name" required></input>
                </p>

                <p>
                    <input name="lastName" placeholder="Last Name" required></input></br>
                </p>

                Upload a photo: <input type="file" name="fileToUpload"><br />
                <p>
                    <label for="status" aria-required="">Choose a Status:</label>
                    <select name="status" id="status" required>
                        <option value="">None</option>
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </p>

            </div>
            <div>
                <button class="signupsubmit" name="submit">submit</button>
                <button class="signupclosebtn" type="button" name="signupclosebtn" style="background-color: red;">close</button>
            </div>
        </form>


    </div>
    <div class="success">
        <span class="successbox"></span>
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "errorusername") {
            echo
            '<script>  
                $(document).ready(function() {
        $(".bg-modal").show();
                $("#messagebox").fadeIn(200).text("This username has been taken already !");
              }); 
              </script>';
        }
    }

    if (isset($_GET["success"])) {
        echo
        '<script>
        $(document).ready(function(){
$(".success").fadeIn(500).text("Successfully created Account !").fadeOut(5000);

        });
        </script>';
    }
    ?>
</body>

<style>
    .success {
        padding: 20px;
        background-color: #04AA6D;
        color: white;
        font-size: 40px;
    }

    .successbox {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .head {
        margin: 0 0 50px 0;
        padding: 10px;
        text-align: center;
        font-size: 30px;
        color: darken(#e5e5e5, 50%);
        border-bottom: solid 1px #e5e5e5;
    }

    .bg-modal {
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0.7;
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        font-family: sans-serif;
    }

    .signup {
        width: 600px;
        height: 700px;
        background-color: #fff;
        text-align: center;
        padding: 4em 4em 2em;
        max-width: 400px;
        margin: 50px auto 0;
        box-shadow: 0 0 1em #222;
        border-radius: 2px;
    }

    p {
        margin: 0 0 3em 0;
        position: relative;
    }

    input {
        display: block;
        box-sizing: border-box;
        width: 100%;
        outline: none;
        margin: 0;
    }

    .signup button {
        background-color: green;
        color: white;
        padding: 5px 35px;
        margin: initial;
    }
</style>

</html>