<?php session_start(); ?>
<?php include 'html/tools.html'; ?>
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
         table,th,td {
         border: 1px solid black;
         color: white;
         }
         .mainbody {
         display: inline-flex;
         color: white;
         background-color: #222D32;
         height: 970px;
         width: 16.6666666667%;
         }
      </style>
      <?php
         require_once "includes/dbh.inc.php";
         require_once "includes/functions.inc.php";
         ?>
      <meta charset="utf-8">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
         $(document).ready(function(){		
         		$("#output").click(function(){							
         			$("tr:gt(0)").hide().filter(":contains('"+$("input").val()+"')").show();
         		});
                 $("#Search").click(function() {
                document.location.href = 'adminSearch.php';
            });


            $("#sick").click(function() {
                document.location.href = 'adminsick.php';
            });

            $("#curryear").click(function() {
                document.location.href = 'admincurrreport.php';
            });

            $("#createbtn").click(function() {
                document.location.href = 'adminpage.php';
            });
            $("#previous").click(function() {
                document.location.href = 'adminpreviousreport.php';
            });
         });	
      </script>	    
   </head>
   <body>
      <div class="container-fluid">
         <div class="col-sm-2 p-0 mainbody">
            <ul>
            <li><button id="createbtn" name=button> Create User </button></li>
            <li><button id="Search" name=button> Search </button></li>
            <li><button id="alluser" name=alluserbutton> View All Users !</button></li>
            <li><button id="sick" name=button> sick </button></li>
            <li><button id="curryear" name=button> current year </button></li>
            <li><button id="previous" name=button> previous year </button></li>
               <!-- <li><button> <a class="nav-link" href="class.php" style="color:white;">CLASS</button></li> -->
               <li>
                  <button>
                  <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                  </button>
               </li>
            </ul>
            <?php
            $id = null;
            $attendance = '';
            $Status = '';
            $attendanceStatus = (string) "aa";
            $StatusStatus = (string) "NULL";
            $Class = $_SESSION["Class"];
            ?>
         <div class="container">
            <div class="row">

                  <h4 class="text-secondary">Create record</h4>

            </div>
         <form method="post" >
            <div >
               <div class="row mt-3">
                  <div >
                     studentid
                  </div>
                  <div class="col-12 col-sm-8 text-secondary font-weight-bold">
                     <input type="text" name="id" value="" 
                        method ="post">
                  </div>
               </div>
               <div >
                  <div class="col-12 col-sm-3">
                     attendance 
                  </div>
                  <div class="col-12 col-sm-8 text-secondary font-weight-bold">
                     <input type="radio" id="Sick Leave" name="attendance" value="Sick Leave">
                     <label for="Sick Leave">Sick Leave</label><br>	
                     <input type="radio" id="none" name="Status" value="none">
                     <label for="none">none</label><br>								
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 text-secondary">
                     <input type="submit" class="btn btn-default" 
                        name="submit" value="Submit">
                  </div>
               </div>
            </div>
         </div>

      </div>
      </div>
      </div>
      </form>
      <?php
         extract($_POST);
         $currdate = date('Y-m-d',time());
         $sql = "SELECT  others, attendance,attday FROM student WHERE studentid = '$id' " ;		
         $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
         $row = mysqli_fetch_assoc($rs);
         if($attendance=="Sick Leave"){
         $attendanceStatus = (string)"Sick Leave";
         }
         $sql = "UPDATE student SET   attendance = '$attendanceStatus' 
         WHERE studentid = '$id' AND attday = '$currdate'";
         mysqli_query($conn, $sql) or die (mysqli_error($conn));
         echo $Status;
         echo $attendanceStatus;
         echo $StatusStatus;
         mysqli_close($conn);
         
         ?>
   </body>
</html>