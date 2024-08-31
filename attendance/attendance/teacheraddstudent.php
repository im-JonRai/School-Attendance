<?php session_start();
include 'html/tools.html';
require_once "includes/dbh.inc.php";
require_once "includes/functions.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* !--   nav bar css --> */
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

        /* css for add button */
        .addbtn {
            width: 100%;
            background-color: green;
            color: white;
            border: none;
        }
    </style>
    <script>
        // profile btn
        $(document).ready(function() {
            $("#profilebtn").click(function() {
                 document.location.href = 'teacherpage.php';
             });
             $("#classbtn").click(function() {
                 document.location.href = 'teacheraddstudent.php';
             });
             $("#myclass").click(function() {
                 document.location.href = 'teachermyclass.php';
             });
         
             $("#Searching").click(function() {
                 document.location.href = 'test.php';
             });
         
             $("#insert").click(function() {
                 document.location.href = 'teacherinsert.php';
             });
         
             $("#change").click(function() {
                 document.location.href = 'teacherchange.php';
             });
             $("#report").click(function() {
                 document.location.href = 'teacherReport.php';
             });		
             $("#Endorsed").click(function() {
                 document.location.href = 'teachercom.php';
             });		
             $("#photo").click(function() {
                 document.location.href = 'teachercheckphoto.php';
             });		
            //  search jquery
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

            // add row to another table jquery
            $(function() {
                $(document).on("click", ".addbtn", function() {
                    var addstudent = $(this).parents("tr");
                    addstudent.appendTo($(".selectedstudent tbody"));
                    addstudent.find('#fname').attr('id', 'selectedfname');
                    addstudent.find('#lname').attr('id', 'selectedlname');
                    addstudent.find('#uname').attr('id', 'selecteduname');
                    $(".selectedstudent button").css("background-color", "red").css("color", "white").css("border", "none").text('R E M O V E').attr('class', 'removebtn');
                })


                $(document).on("click", ".removebtn", function() {
                    var removestudent = $(this).parents("tr");
                    removestudent.appendTo($("#studentlist tbody"));
                    removestudent.find('#selectedfname').attr('id', 'fname');
                    removestudent.find('#selectedlname').attr('id', 'lname');
                    removestudent.find('#selecteduname').attr('id', 'uname');
                    $("#studentlist button").addClass('addbtn').css("background-color", "green").text('A D D ').attr('class', 'addbtn');
                })


            });
            // creates the class and adds the student into the class at database
            $("#createclass").click(function() {

                var fnamearray = [];
                var lnamearray = [];
                var unamearray = [];
                var count = 0;
                var count2 = 0;
                var count3 = 0;
                $("#classtable,table,tr").each(function(index) {
                    $(this).find("#selectedfname").each(function(index) {
                        if (count != 0)
                            fnamearray.push($(this).text());
                        count++;
                    });
                    $(this).find("#selectedlname").each(function(index) {
                        if (count2 != 0)
                            lnamearray.push($(this).text());
                        count2++;
                    });
                    $(this).find("#selecteduname").each(function(index) {
                        if (count3 != 0)
                            unamearray.push($(this).text());
                        count3++;
                    });
                });




                $.ajax("includes/teacheraddstudent_db.inc.php", {
                    type: "POST",
                    data: {
                        class: $("#classname").val(),
                        date: $("#classdate").val(),
                        teacher: $("#teachername").text(),
                        studentfname: JSON.stringify(fnamearray),
                        studentlanme: JSON.stringify(lnamearray),
                        studentuname: JSON.stringify(unamearray)
                    },
                    success: function(data) {
                        location.reload();
                        alert("successfuly Created Class");

                    },
                    error: function(data) {
                        alert("Failed to Create the Class or add student into the database");
                    }
                });
            });
        });
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
            <li><button id="Searching" name=button>Searching</button></li>
            <li><button id="insert" name=button>insert</button></li>
            <li><button id="change" name=button>change</button></li>
            <li><button id="report" name=button>report</button></li>
            <li><button id="Endorsed" name=button>Endorsed </button></li>
            <li><button id="photo" name=button>check photo </button></li>
                        <!-- <li><button> <a class="nav-link" href="class.php" style="color:white;">CLASS</button></li> -->
                        <li>
                            <button>
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-5 p-0 studentlist">
                <div class="title" style="color:white;">CREATE CLASS</div>
                </br>
                </br>
                <label style="color:white;" class="placeholder">Class Name :</label>
                <?PHP print_r('  <input id="classname" type="text" value="' . $_SESSION["Class"] . '" placeholder="' . $_SESSION["Class"] . ' " />'); ?>
                </br>
                </br>
                <input type='date' id='classdate' value='<?php echo date('Y-m-d'); ?>' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a style="color:white;"> Class Teacher :</a>
                <a id="teachername" style="color:Aqua;"><?php echo $_SESSION["name"]; ?></a>
                </br>
                </br>

                <div style="width: 60%;">

                    <table class="selectedstudent" style="width:100%;" id="classtable">
                        <tr>
                            <th>IMG</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>student number</th>
                            <th>R E M O V E</th>
                        </tr>

                    </table>

                </div>
                <hr style="width: 60%;">
                <button type="submit" id="createclass">C R E A T E</button>


            </div>




            <div class="col-5 topcreate" style="padding-left: 5%;">
                <?php
                echo '<br />Search for Student by username<div class="form-outline">
                        <input type="search" id="filter" class="form-control" placeholder="Type Student UserName" style="background-color: pink;" aria-label="Search" />
                    </div><br />'; ?>
                <?php
                $sql = "SELECT * FROM atten WHERE Class = 'N/A' AND `status` = 'student'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table id="studentlist" style="width:100%;">
                                <tr>
                                    <th>IMG</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>student number</th>
                                    <th>A D D</th>
                                </tr>';
                    while ($row = mysqli_fetch_array($result)) {
                        print('
                                    <tr>
 <td><img style="width: 50px;height: 50px;" src="includes/userphoto/' . $row['profile_picture'] . '"/></td>
        <td id="fname">' . $row['firstName'] . '</td>
        <td id="lname">' . $row['lastName'] . '</td>
        <td id="uname">' . $row['userName'] .  '</td>
');
                        echo '<td><button type="button" class="addbtn">A D D </button></td>';
                        echo '  </tr>';
                    }
                    echo '</table>';
                } else {
                    echo 'All student has been added to class or there is no student';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>