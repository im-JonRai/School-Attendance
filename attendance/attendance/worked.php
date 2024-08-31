<?php session_start();
include 'html/tools.html';
require_once "includes/dbh.inc.php";
require_once "includes/functions.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 200px;
            height: 100%;
            background-color: #27EF9F;
            padding-left: 0rem;
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

        /* holy body background color */

        body {
            background-color: #222D32;
        }
    </style>
    <script>
        // $(document).ready(function() {
        //     $("#profilebtn").click(function() {
        //         document.location.href = 'teacherpage.php';
        //     });

        //     $("#classbtn").click(function() {
        //         document.location.href = 'teacheraddstudent.php';
        //     });
        // });
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="height: 100%;">
            <div class="col-sm-2 p-0">
                <nav>
                    <ul>
                        <li><button id="profilebtn" name=button> PROFILE</button></li>
                        <li><button id="classbtn" name=button>CREATE CLASS</button></li>
                        <li><button id="myclass" name=button>My Class</button></li>
                        <!-- <li><button> <a class="nav-link" href="class.php" style="color:white;">CLASS</button></li> -->
                        <li>
                            <button>
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- another table for conten -->
            <div class="col-5 p-0 studentlist">
            </div>



            <!-- another table for conten -->
            <div class="col-5 topcreate" style="padding-left: 5%;">
            </div>


        </div>
    </div>
</body>

</html>