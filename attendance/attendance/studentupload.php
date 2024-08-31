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
            $("#stuSearching").click(function() {
                document.location.href = 'studentSearch.php';
            });	
            $("#upload").click(function() {
                document.location.href = 'studentupload.php';
            });	
            $("#profilebtn").click(function() {
                document.location.href = 'studentpage.php';
            });
	});	
</script>	    
</head>



<body>
<div class="container-fluid">
    <div class="col-sm-2 p-0 mainbody">
        <ul>
        <li>
            <button id="profilebtn" name=button> PROFILE</button></li>
            <li><button id="stuSearching" name=button>Search</button></li>
            <li><button id="upload" name=button>Upload</button></li>

            <!-- <li><button> <a class="nav-link" href="class.php" style="color:white;">CLASS</button></li> -->
            <li>
                <button>
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                </button>
            </li>
        </ul>
        <div>
<form method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="image" id="image" value="" />
  
            <div>
                <button type="submit"
                        name="upload">
                  UPLOAD
                </button>
            </div>
        </form>
        <?php
	$currdate = date('Y-m-d',time());

    $stuid = $_SESSION["id"];
  //  echo $stuid;
    $msg = "";
  
  if (isset($_POST['upload'])) {
  
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "image/".$filename;
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));      
    //$db = mysqli_connect("localhost", "root", "", "attendance");
  
    $sql = "UPDATE student SET sickcert = '$file' 
    WHERE studentid = '$stuid' AND attday = '$currdate'";
     mysqli_query($conn, $sql) or die (mysqli_error($conn));  
        // Execute query
          

  }



  $result = mysqli_query($conn, "SELECT * FROM student WHERE studentid='$stuid' AND attday = '$currdate' " );
  while($row = mysqli_fetch_array($result)){
  echo '<img src="data:image/jpeg;base64,'.base64_encode($row["sickcert"]) .'"alt="Image" />';
  }
?>
    </div>
    </div>		

</div>

</body>
</html>