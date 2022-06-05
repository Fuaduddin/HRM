<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your Awosome Company</title>
    <link rel="stylesheet" href="view.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="profile.css">
     <link rel="stylesheet" href="form.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <div class="sidebar" >
        <?php 
        $un = $_SESSION['username'];
$con = mysqli_connect("localhost","root","","crm");
$sql = "select * from admin where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                echo "<i style='font-size: 14px; color: white;'>".$row["a_idd"]."</i>"."<br />"; 
            ?>
         <a href="superadmineditprofile.php"<?php  $_SESSION['superadmin']=$row["a_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="spprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="viewadmin.php"><i class='fas fa-business-time' style='font-size:20px'></i> SUPERVISIOR</a></li>
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>STAFFS</a></li>
            <li><a href="addsupervisior.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD SUPERVISIOR</a></li>
            <li><a href="addstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD EMPLOYEE</a></li>
            <li><a href="viewleave.php"><i class='fas fa-business-time' style='font-size:20px'></i>PREVIOUS LEAVE</a></li>
            <li><a href="addviewjobcategories.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE JOB CATEGORY</a></li>
            <li><a href="addviewleavetype.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE LEAVE TYPE</a></li>
            <li><a href="addviewworkweek.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE WORK WEEK</a></li>
            <li><a href="addvieweducation.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE EDUCATION</a></li>
            <li><a href="addviewleavetype.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE SKILLS</a></li>
            <li><a href="addviewpaygrade.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE PAY GRADE</a></li>
            <li><a href="addviewjobtitles.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE JOB TITLE</a></li>
            <li><a href="holiday.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE HOLIDAY</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div> 
<?php
$con = mysqli_connect("localhost","root","","hrm");
if(isset($_POST['add'])){
    $grade = $_POST["grade"];
     $currency = $_POST["currency"];
     $salary = $_POST["salary"];
    $exit= "SELECT * FROM `paygrade` WHERE  grade ='$grade'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
   {
      echo '<script>alert(" paygrade is already exist")</script>';
 }
    else{
       
          $c = "INSERT INTO `paygrade`(`grade`,`currency`,`msalary`) VALUES ('$grade','$currency','$salary')";
          $query2 = mysqli_query($con,$c);
            echo '<script>alert("New jobcategories is added ")</script>';
		
    }
}
		
    mysqli_close($con);
?>
<head>
    <title>Your Awosome Company</title> 
</head>
    <button class="open-button" onclick="openForm()">ADD </button>

<div class="form-popup" id="myForm">
  <form action="addviewpaygrade.php" class="form-container" method="POST" enctype="multipart/form-data">

    <label for="text"><b>ADD NEW paygrade </b></label>
    <input type="text" placeholder="Grade Name" name="grade" required>
         <label for="text"><b>Currency </b></label>
    <input type="text" placeholder="Grade Name" name="currency" required>
         <label for="text"><b>Salary</b></label>
    <input type="text" placeholder="Grade Name" name="salary" required>
 <button type="submit" name="add" class="btn">Add</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
     <center>
    <div class="container" style=" align-content: center; padding-top:40px;">
   <div id="result" style="padding-left: 150px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
                                   
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Grade</th>
                                             <th>Currency</th>
                                             <th>Salary</th>
											<th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>    
									<?php
                $con = mysqli_connect("localhost","root","","hrm");
    
                $sql = "select * from `paygrade` order by grade ";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $row["grade"];
                                        echo "</td>";
                                       echo "<td>";
                                            echo $row["currency"];
                                        echo "</td>";
                                       echo "<td>";
                                            echo $row["msalary"];
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                           <a href="addviewpaygrade.php?del=<?php echo $row["p_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                            <?php
                                        echo "</td>";
                                    
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                }
                else
                {
                    echo "There is no jobcategories is added yet.";
                }
                mysqli_close($con);
            ?>                     
                                        
                                    </tbody>
                                </table>
                  
        </div>
    </div>
    </div>
  </div>
    </center>
                            
</body>
</html>
<?php


if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    $con = mysqli_connect("localhost","root","","hrm");
    
    $sql = "Delete from `paygrade`  where p_id=$id";
    
    $query = mysqli_query($con,$sql);
     if($query){
        echo "<script type='text/javascript'> alert('Job Categories is deleted')</script>";
        echo '<script>window.location="addviewpaygrade.php"</script>';
    }
    else{
        echo mysqli_error($con);
    }
    
}
?>