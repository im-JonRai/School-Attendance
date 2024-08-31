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
<select id="class" name="class" >
  <option value="none">select</option>
  <option value="1A">1a</option>
  <option value="1B">1b</option>
</select>
<input type="text" id="studentname" name="studentname" value="">
<input type="submit" class="btn btn-default" name="submit" value="output">

</form>
    <?php
		  extract($_POST);
		  	echo $class;
        	$sql = "SELECT COUNT(class) AS Maxid FROM student where class='$class'";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $Maxid = $rsmax["Maxid"] ;
            $count = 0;
            echo $Maxid;
			$sql = "SELECT COUNT(studentname) AS Maxname FROM student where studentname='$studentname'";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $Maxname = $rsmax["Maxname"] ;
            $count = 0;
            echo $Maxname;
    ?>

<table class="table mt-1">

	<tr>
		<th>record</th>
		<th>studentid</th>
		<th>name</th>
		<th>classno</th>
		<th>class</th>
		<th>date</th>

	</tr>
	<?php
		echo $studentname;
        echo $class;
		if($class == 'none'){

			do{
				if ($count == 0){
				$sql = "SELECT * FROM student where studentname='$studentname' ORDER BY record ASC  LIMIT 1 ";
				$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$arow = mysqli_fetch_assoc($ra);
				if (isset($arow["classno"]) == 1 ){
				$id = $arow["studentid"] ;}}else{
				$sql = "SELECT * FROM student where studentname='$studentname' ORDER BY record ASC  LIMIT $count,1 ";
				$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$arow = mysqli_fetch_assoc($ra);}	
				if (isset($arow["classno"]) == 1 ){
				$id = $arow["studentid"] ;}
				$sql = "SELECT * FROM student WHERE studentid = '$id'" ;	
				$rdata = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$datarow = mysqli_fetch_assoc($rdata);
				if (isset($arow["classno"]) == 1) {
				$name = $arow["studentname"] ;}
				if (isset($arow["classno"]) == 1 ){
				$date = $arow["attday"] ;}
				if (isset($arow["classno"]) == 1 ){
				$others = $arow["others"] ;}
				if (isset($arow["classno"]) == 1 ){
				$classno = $arow["classno"] ;}
				if (isset($arow["classno"]) == 1 ){
				$class = $arow["class"] ;}	
				if (isset($arow["classno"]) == 1 ){
				$record = $arow["record"] ;}			
			
				print("
								<tr>
				<td>$record</td>
				<td>$id</td>
				<td>$name</td>
				<td>$classno</td>
				<td>$class</td>
				<td>$date</td>
		
						
			</tr>
				");
		
				$count = $count + 1; 
				echo $count;
			}while ($count != $Maxname );
		}else { do{
		if ($count == 0){
		$sql = "SELECT * FROM student where class='$class' ORDER BY record ASC  LIMIT 1 ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$arow = mysqli_fetch_assoc($ra);
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$id = $arow["studentid"] ;}}else{
		$sql = "SELECT * FROM student where class='$class' ORDER BY record ASC  LIMIT $count,1 ";
		$ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$arow = mysqli_fetch_assoc($ra);}	
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$id = $arow["studentid"] ;}
		$sql = "SELECT * FROM student WHERE studentid = '$id'" ;	
		$rdata = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$datarow = mysqli_fetch_assoc($rdata);
		if (isset($arow["classno"]) == 1) {
		$name = $arow["studentname"] ;}
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$date = $arow["attday"] ;}
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$others = $arow["others"] ;}
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$classno = $arow["classno"] ;}
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$class = $arow["class"] ;}	
		if (isset($arow["classno"]) == 1 AND isset($arow["class"]) == $class){
		$record = $arow["record"] ;}			
	
		print("
						<tr>
		<td>$record</td>
		<td>$id</td>
		<td>$name</td>
		<td>$classno</td>
		<td>$class</td>
        <td>$date</td>

		</tr>
		");

		$count = $count + 1; 
		echo $count;
	}while ($count != $Maxid );
}
	?>
</table>
</body>
</html>