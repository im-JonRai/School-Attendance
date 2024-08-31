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
        $year = date("Y",time());
        $YEARstart = $year . "/9/1";
        $YEAREND = $year + 1 . "/8/30";
        $teaclass = $_SESSION["Class"];
        $recocount = 0;
        $count = 0;
        $countclass = 0;
        $counter = 0;
        $countlop = 0;
        $sql = "SELECT COUNT(id) AS Maxid FROM atten where `status`='student' AND accountstatus='enable'  ";
        $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rsmax = mysqli_fetch_assoc($smax);
        $Maxid = $rsmax["Maxid"] ;
//        echo  $Maxid;
        $sql = "SELECT COUNT(class_id) AS maxclass FROM class WHERE `date` between '$YEARstart' AND '$YEAREND'  ";
        $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rsmax = mysqli_fetch_assoc($smax);
        $maxclass = $rsmax["maxclass"] ;
//        echo  $maxclass;
        do{
            if ($countclass == 0){
            $sql = "SELECT * FROM class WHERE `date` between '$YEARstart' AND '$YEAREND' ORDER BY class_id ASC  LIMIT 1 ";
            $ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $arow = mysqli_fetch_assoc($ra);
            $class = $arow["class_name"] ;
            $stack = array($class);
            $countclass = $countclass + 1; 
        }
            elseif ($countclass >= 0){
            $sql = "SELECT * FROM class WHERE `date` between '$YEARstart' AND '$YEAREND' ORDER BY class_id ASC  LIMIT $countclass,1 ";
            $ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $arow = mysqli_fetch_assoc($ra);
            $class = $arow["class_name"] ;
            array_push($stack, $class);
            $countclass = $countclass + 1; 
        }	
 //       var_dump($stack);

 //           echo $countclass . 'ddd';
         //   $numcount = count($class);

//            echo $stack;
        }while ($countclass < $maxclass );
        do{
            
        $sql = "SELECT COUNT(record) AS Maxrecord FROM student WHERE class='$stack[$countlop]'";
        $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rsmax = mysqli_fetch_assoc($smax);
        $Maxrecord = $rsmax["Maxrecord"] ;
        $recocount  = $recocount + $Maxrecord;
        $countlop =  $countlop + 1;

    }while ($countlop >= count($stack) );
    $stackno = $stack[$counter];
//    echo $stackno;
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
    <th>Present rate</th>
    <th>Late rate</th>
    <th>Absent rate</th>
    <th>Sick rate</th>
    <th>Personal leave rate</th>
    <th>Early leave rate</th>

</tr>
<?php   
        do{
            $stackno = $stack[$counter];
//            echo $stackno;
            $sql = "SELECT COUNT(record) AS stoper FROM student WHERE class='$stackno'";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $stoper = $rsmax["stoper"] ;
            if($stoper != 0 ){
        do{ 

            if ($count == 0){
            $sql = "SELECT * FROM atten WHERE class='$stack[$counter]' AND `status`='student' ORDER BY id ASC  LIMIT 1 ";
            $ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $arow = mysqli_fetch_assoc($ra);
            if (isset($arow["record"]) == 1 ){
            $id = $arow["id"] ;
        }}
            else{
            $sql = "SELECT * FROM atten WHERE class='$stack[$counter]' AND `status`='student' ORDER BY id ASC  LIMIT $count,1 ";
            $ra = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $arow = mysqli_fetch_assoc($ra);}				
            $id = $arow["id"] ;
//            echo "stid=".$id;
            $sql = "SELECT * FROM student WHERE studentid = '$id'" ;	
            $rdata = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $datarow = mysqli_fetch_assoc($rdata);

            $sql = "SELECT COUNT(record) AS couOfStu FROM student WHERE class='$stack[$counter]' AND studentid='$id' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $couOfStu = $rsmax["couOfStu"] ;   
 //           echo $couOfStu . "*";

            $sql = "SELECT COUNT(record) AS numOfPre FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Present' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfPre = $rsmax["numOfPre"] ;
 //           echo $numOfPre;
//             if($numOfPre = 0 || $couOfStu= 0){
  //              $ratePre = 0;
    //        }else{
            $ratePre =  round(($numOfPre / $couOfStu) * 100).'%';//}

            $sql = "SELECT COUNT(record) AS numOfLate FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Late' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfLate = $rsmax["numOfLate"] ;

            $rateLate =  round(($numOfLate / $couOfStu)*100).'%' ;

            $sql = "SELECT COUNT(record) AS numOfAWR FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Absent without reason' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfAWR = $rsmax["numOfAWR"] ;

            $rateAWR =  round(($numOfAWR / $couOfStu)*100).'%';

            $sql = "SELECT COUNT(record) AS numOfSL FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Sick Leave' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfSL = $rsmax["numOfSL"] ;

            $rateOfSL =  round(($numOfSL / $couOfStu)*100).'%';

            $sql = "SELECT COUNT(record) AS numOfPL FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Personal leave' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfPL = $rsmax["numOfPL"] ;

            $rateOfPL =  round(($numOfPL / $couOfStu)*100).'%';

            $sql = "SELECT COUNT(record) AS numOfEL FROM student WHERE class='$stack[$counter]' AND studentid='$id' AND attendance='Early leave' ";
            $smax = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rsmax = mysqli_fetch_assoc($smax);
            $numOfEL = $rsmax["numOfEL"] ;

            $rateOfEL =  round(($numOfEL / $couOfStu)*100).'%';

            print("
                            <tr>
            <td>$count</td>
            <td>$id</td>
            
            <td>$ratePre</td>
            <td>$rateLate</td>		
            <td>$rateAWR</td>	
            <td>$rateOfSL</td>					
            <td>$rateOfPL</td>					
            <td>$rateOfEL</td>					

        </tr>
            ");
    
            $count = $count + 1; 
 //           echo $count;
 //           echo $Maxid ."next";
        }while ($count < $Maxid);
            }
        $counter = $counter +1 ;
    }while ($counter < $countclass);
?>
</table>
        </div>
    </div>	
</div>	


    </body>
</html>