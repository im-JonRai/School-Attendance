<?php session_start(); ?>
<?php include 'html/tools.html'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "includes/dbh.inc.php";
    require_once "includes/functions.inc.php";
    ?>

</head>



<body>


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
		<div class="col-12 my-2">
			<h4 class="text-secondary">Create record</h4>
		</div>
	</div>
</div>
<form method="post" >
<div class="container">
        <div class="row mt-3">
			<div class="col-12 col-sm-3">
				studentid
			</div>

			<div class="col-12 col-sm-8 text-secondary font-weight-bold">
				<input type="text" name="id" value="" 
				method ="post">
			</div>
		</div>

        <div class="row mt-3">
			<div class="col-12 col-sm-3">
				 attendance 
			</div>

			<div class="col-12 col-sm-8 text-secondary font-weight-bold">
				<input type="radio" id="Present" name="attendance" value="Present">
				<label for="Present">Present</label><br>
				<input type="radio" id="Late" name="attendance" value="Late">
				<label for="Late">Late</label><br>
				<input type="radio" id="Absent without reason" name="attendance" value="Absent without reason">
				<label for="Absent without reason">Absent without reason</label><br>					
				<input type="radio" id="Personal leave" name="attendance" value="Personal leave">
				<label for="Sick Leave">Personal leave</label><br>								
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-12 col-sm-3">
				 Status 
			</div>

			<div class="col-12 col-sm-8 text-secondary font-weight-bold">
				<input type="radio" id="Early leave" name="Status" value="Early leave" method ="post">
				<label for="Early leave">Early leave</label><br>
				<input type="radio" id="none" name="Status" value="none">
				<label for="none">none</label><br>					</div>
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
</form>


<?php
        extract($_POST);
		$currdate = date('Y-m-d',time());
		$sql = "SELECT  others, attendance,attday FROM student WHERE studentid = '$id' " ;		
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$row = mysqli_fetch_assoc($rs);
		if($attendance==(string)"Present"){
			$attendanceStatus = (string)"Present";
		}
		if($attendance=="Late"){
			$attendanceStatus = (string)"Late";
		}
		if($attendance="Absent without reason"){
			$attendanceStatus = (string)"Absent without reason";
		}			
		if($attendance="Personal leave"){
			$attendanceStatus = (string)"Personal leave";
		}			
		if($Status=="Early leave"){
			$StatusStatus = (string)"Early leave";
		}		
    	$sql = "UPDATE student SET others = '$StatusStatus' ,   attendance = '$attendanceStatus' 
       WHERE studentid = '$id' AND attday = '$currdate'";
		mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
	
    echo $Status;
    echo $attendanceStatus;
    echo $StatusStatus;
	mysqli_close($conn);
	
?>
</body>
</html>