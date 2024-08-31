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
<form action="" method="post" >
<input type="submit" class="btn btn-default" name="submit" value="insert">
</form>
    <?php
			$teaclass = $_SESSION["Class"];
			echo $teaclass;
			if (isset($_POST['submit'])){
				extract($_POST);
            $sql = "SELECT COUNT(id) AS Maxid FROM atten where class='$teaclass' AND `status`='student' AND accountstatus='enable' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $Maxid = $rsmax["Maxid"] ;
            $count = 0;
            echo $Maxid;
            $sql = "SELECT COUNT(record) AS Maxno FROM student ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $Maxno = $rsmax["Maxno"] ;

            echo $Maxno;
    ?>




	<?php
		$currdate = date('Y-m-d',time());
        $recond = $Maxno +1 ;
		do{
		if($recond == 0){
			$recond = $recond +1 ;
		}
		echo $recond;
		$name = "";
		if ($count == 0){
		$sql = "SELECT * FROM atten where Class='$teaclass' AND `status`='student' AND accountstatus='enable' ORDER BY id ASC  LIMIT 1 ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$arow = mysqli_fetch_assoc($ra);
		$id = $arow["id"]  ;}else{
		$sql = "SELECT * FROM atten where Class='$teaclass' AND `status`='student' AND accountstatus='enable' ORDER BY id ASC  LIMIT $count,1 ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$arow = mysqli_fetch_assoc($ra);}	
		$id = $arow["id"] ;

		$sql = "SELECT * FROM atten WHERE id = '$id' " ;	
		$rdata = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$datarow = mysqli_fetch_assoc($rdata);
		if (isset($arow["id"]) == 1 ){
		$name = $arow["firstName"]. " ".$arow["lastName"] ;}
		if (isset($arow["id"]) == 1 ){
		$class = $arow["Class"] ;}	
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));		
		if($Maxno != 0){
		$sql = "INSERT INTO student (record, studentname,   attday, attendance, studentid ,class)
        SELECT '$recond', '$name',   '$currdate', 'Present', '$id' ,'$class' FROM student
WHERE NOT EXISTS (SELECT * FROM student WHERE studentid = '$id' AND attday = '$currdate' ) LIMIT 1 ; ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));		
		}else {
		
		$sql = "INSERT INTO student (record, studentname,   attday, attendance, studentid ,class) VALUES ('$recond' , '$name' , '$currdate', 'Present', '$id' ,'$class')  ; ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));		
		}
        $recond = $recond + 1; 
		$count = $count + 1; 
	}while ($count != $Maxid );
}
	?>




</body>



</html>