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
        <div class="col-5 p-0 search">


    <?php
		  extract($_POST);
            $teaclass = $_SESSION["Class"];
        	$sql = "SELECT COUNT(record) AS Maxrecord FROM student";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $Maxrecord = $rsmax["Maxrecord"] ;
            $count = 0;
     //       echo $Maxrecord;
    ?>
<form action="" method="post" >
<input type="text" id="studentname" name="studentname" value="">
<input type="button" id="output"  class="btn btn-default" name="submit" value="output">
</form>
<table class="table mt-1">

	<tr>
		<th>record</th>
		<th>studentid</th>
        <th>studentname</th>
		<th>date</th>
		<th>static</th>
		<th>attendance</th>

	</tr>
	<?php

	

			do{
				if ($count == 0){
				$sql = "SELECT * FROM student  ORDER BY record ASC  LIMIT 1 ";
				$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$arow = mysqli_fetch_assoc($ra);
				if (isset($arow["record"]) == 1 ){
				$id = $arow["studentid"] ;}}else{
				$sql = "SELECT * FROM student  ORDER BY record ASC  LIMIT $count,1 ";
				$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$arow = mysqli_fetch_assoc($ra);}	
				if (isset($arow["record"]) == 1 ){
				$id = $arow["studentid"] ;}
				$sql = "SELECT * FROM student WHERE studentid = '$id'" ;	
				$rdata = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$datarow = mysqli_fetch_assoc($rdata);
				if (isset($arow["record"]) == 1 ){
				$date = $arow["attday"] ;}
				if (isset($arow["record"]) == 1 ){
				$others = $arow["others"] ;}
                if (isset($arow["record"]) == 1 ){
                $studentname = $arow["studentname"] ;}
				if (isset($arow["record"]) == 1 ){
				$record = $arow["record"] ;}			
				if (isset($arow["record"]) == 1 ){
				$attendance = $arow["attendance"] ;}				
				print("
								<tr>
				<td>$record</td>
				<td>$id</td>
                <td>$studentname</td>
				<td>$date</td>
				<td>$others</td>		
				<td>$attendance</td>						
			</tr>
				");
		
				$count = $count + 1; 
			//	echo $count;
			}while ($count != $Maxrecord );
		
	?>
</table>
</div>
</div>		

</div>	
</body>
</html>