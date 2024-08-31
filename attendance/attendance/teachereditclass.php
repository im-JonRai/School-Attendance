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

        table,
        th,
        td {
            border: 1px solid black;
            color: white;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#profilebtn").click(function() {
                document.location.href = 'teacherpage.php';
            });

            $("#classbtn").click(function() {
                document.location.href = 'teacheraddstudent.php';
            });
            $("#Searching").click(function() {
                document.location.href = 'test.php';
            });
            // search bar jquery
            $('#filter').keyup(function() {

                var txt = $(this).val().toLowerCase().trim();

                $("#studentlist,table,tr").each(function(index) {
                    if (!index) return;
                    $(this).find("#uname").each(function() {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(txt) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                });
            });

            //checkbox to be selected only one
            $("input:checkbox").on('click', function() {
                var selectbox = $(this);
                $(selectbox).on('change', function() {
                    $(this).siblings('input[type="checkbox"]').prop('checked', false);
                });
            });

            //remove button, removes from database and table
            $(".removebtn").click(function() {
                var removestudent = $(this).val();
                $.ajax(
                    'http://localhost/attendance/includes/teacherclassedit_remove.inc.php', {
                        type: 'POST',
                        data: {
                            studentid: removestudent,
                        },
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {
                            alert("System couldnt REMOVE " + removestudent + "from the database" + err);

                        }
                    });
            });

            // edit button, edit for student

            $(".editbtn").click(function() {


                var studentfname = $(this).parents("td").siblings("#fname").html();
                var studentlname = $(this).parents("td").siblings("#lname").html();
                var studentuname = $(this).parents("td").siblings("#uname").html();
                var studentpass = dwad;

                document.getElementById("editfname").placeholder = studentfname;
                document.getElementById("editlname").placeholder = studentlname;
                document.getElementById("edituname").placeholder = studentuname;

                $.ajax('http://localhost/attendance/includes/teacherclassedit_editstudent.inc.php', {
                    type: 'POST',
                    data: {
                        fname: studentfname,
                        lname: studentlname,
                        uname: studentuname
                    },
                    success: function(data) {


                    },
                    error: function(data) {
                        alert("System couldnt EDIT " + removestudent + "from the database" + err);

                    }

                });

            });
        });
        // apply button apply the changes

        // var for edit
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
                        <li><button id="Searching" name=button>My Class</button></li>
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
            <div class="col-5 topcreate" style="padding-left: 5%;">
                <div class="title" style="color:white;">CREATE CLASS</div>
                </br>
                </br>
                <label style="color:white;" class="placeholder">Class Name :</label>
                <?PHP print_r('  <input style="color:#9932CC;" placeholder=" ' . $_SESSION["Class"] . '"  />'); ?>
                </br>
                </br>

                <a style="color:white;"> Class Teacher :</a>
                <?PHP print_r('  <input id="teachername" placeholder=" ' . $_SESSION["name"] . '"  />'); ?>
                </br>
                </br>
                <?php
                echo '<br />Search for Student by username<div class="form-outline">
                        <input type="search" id="filter" class="form-control" placeholder="Type Student UserName" style="background-color: pink;" aria-label="Search" />
                    </div><br />'; ?>
                <?php
                $sql = "SELECT * FROM atten WHERE Class = '$_SESSION[Class]' AND `status` = 'student'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table id="studentlist" style="width:100%;">
                                <tr>
                                  <th>ID</th>
                                    <th>IMG</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>student number</th>
                                    <th>R E M O V E </th>
                                     <th>E D I T</th>
                                </tr>';
                    while ($row = mysqli_fetch_array($result)) {
                        print('
                                    <tr>
                                     <td id="id">' . $row['id'] . '</td>
 <td><img style="width: 50px;height: 50px;" src="includes/userphoto/' . $row['profile_picture'] . '"/></td>
        <td id="fname" value="' . $row['firstName'] . '">' . $row['firstName'] . ' </td>
        <td id="lname" value="' . $row['lastName'] . ' ">' . $row['lastName'] . '</td>
        <td id="uname" value="' . $row['userName'] . '">' . $row['userName'] . '</td>
');
                        echo '<td><button class="removebtn" value= " ' . $row['id'] . ' " style="width:100%;color:white;background-color:red;border:none;"> R E M O V E</button></td>';
                        echo '<td><button  class="editbtn"  style="width:100%;border:none;background-color:blue;color:white;">E D I T</button></td>';
                        echo '  </tr>';
                    }
                    echo '</table>';
                } else {
                    echo 'All student has been added to class or there is no student';
                }
                ?>
                <div>
                    <button id="editclassbtn" style="margin-top:5%;background-color:green;border:none;color:white;">A P P L Y</button>
                </div>
            </div>
            
<!--  work on
            <div class="classstudenteditinfo">
                <form action="" method="">
                    <input id="editfname" type="text" placeholder=""></input>
                    <input id="editlname" type="text" placeholder=""></input>
                    <input id="edituname" type="text" placeholder=""></input>
                    <input type="text">
                </form>
            </div> -->


        </div>
    </div>
</body>

</html>