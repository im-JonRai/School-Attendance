<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'html/tools.html';
require_once "includes/dbh.inc.php";
require_once "includes/functions.inc.php";
?>

<head>
    <style>
        /* this part css is for profile fade in and fade out*/
        .success {
            padding: 20px;
            background-color: #04AA6D;
            color: white;
            font-size: 40px;
        }

        .successbox {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .profilename {
            margin: 0 0 50px 0;
            padding: 10px;
            text-align: center;
            font-size: 30px;
            color: darken(#e5e5e5, 50%);
            border-bottom: solid 1px #e5e5e5;
        }

        .bg-modal {
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.7;
            position: absolute;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            font-family: sans-serif;
        }

        .editprofile {
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.7;
            position: absolute;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            font-family: sans-serif;
        }

        .signup {
            width: 600px;
            height: 650px;
            background-color: #fff;
            text-align: center;
            padding: 4em 4em 2em;
            max-width: 400px;
            margin: 50px auto 0;
            box-shadow: 0 0 1em #222;
            border-radius: 2px;
        }

        .prof {
            width: 600px;
            height: 650px;
            background-color: #fff;
            text-align: center;
            padding: 4em 4em 2em;
            max-width: 400px;
            margin: 50px auto 0;
            box-shadow: 0 0 1em #222;
            border-radius: 2px;
        }

        label {
            color: black;
        }

        .signup button {
            background-color: green;
            color: white;
            padding: 5px 35px;
            margin: initial;
        }


        /* this is for main page css*/
        .mainpage {
            width: 100%;
            padding: 1px 16px;
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

        .mainbody {
            display: inline-flex;
            color: white;
            background-color: #222D32;
            height: 970px;
            width: 100%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 200px;
            height: 100%;
            background-color: #27EF9F;
            padding-left: 0rem;
        }
    </style>
    <script>
        $(document).ready(function() {
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

        });
    </script>
</head>

<body>
    <?php
    $id=0;
    ?>
    <div class="mainbody">
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
        
        <form method="post" >
                     <div class="col-12 col-sm-3">
                        studentid
                     <div class="col-12 col-sm-8 text-secondary font-weight-bold">
                        <input type="text" name="id" value="" method ="post">
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-12 text-secondary">
                        <input type="submit" class="btn btn-default" 
                           name="submit" value="Submit">
                     </div>
                  </div>
                  <?php
               		  extract($_POST);
	$currdate = date('Y-m-d',time());

    $stuid = $_SESSION["id"];
 //   echo $id;
    $msg = "";
if($id==NULL){
    $id = 0;
}else{
 $result = mysqli_query($conn, "SELECT * FROM student WHERE studentid='$id' AND attday = '$currdate' " );
  while($row = mysqli_fetch_array($result)){
  echo '<img src="data:image/jpeg;base64,'.base64_encode($row["sickcert"]) .'"alt="Image" />';
  }
}
  ?>
               </div>


         </div>
      </div>
      </form>
    </div>

<div>
    
</div>

</body>


</html>