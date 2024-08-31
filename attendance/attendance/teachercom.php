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
            $("#classbtn").click(function() {
                document.location.href = 'teacheraddstudent.php';
            });

            //this jqery goes to teacherclass.php to edit and show class
            $("#myclass").click(function() {
                document.location.href = 'teachermyclass.php';
            });

            $("#Searching").click(function() {
                document.location.href = 'test.php';
            });

            $("#insert").click(function() {
                document.location.href = 'c.php';
            });

            $("#change").click(function() {
                document.location.href = 'b.php';
            });
            $("#report").click(function() {
                document.location.href = 'teacherReport.php';
            });		
            $("#Endorsed").click(function() {
                document.location.href = 'teachercom.php';
            });		
            $("#profilebtn").click(function() {
                document.location.href = 'teacherpage.php';
            });		
	});	
</script>	    
</head>



<body>
<div class="container-fluid">
    <div class="col-sm-2 p-0 mainbody">
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
        <div>
            
        </div>
    </div>		

</div>



<?php
        extract($_POST);
		$currdate = date('Y-m-d',time());
		$sql = "SELECT  * FROM student WHERE studentid = '$id' " ;		
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