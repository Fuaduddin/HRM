<?php
session_start();
$con = mysqli_connect("localhost","root","","hrm");
if(isset($_POST['add'])){
    $name = $_POST["name"];
    $exit= "SELECT * FROM `education` WHERE  name ='$name'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
   {
      echo '<script>alert(" Level is already exist")</script>';
 }
    else{
       
          $c = "INSERT INTO `education`(`name`) VALUES ('$name')";
          $query2 = mysqli_query($con,$c);
            echo '<script>alert("New Level is added ")</script>';
		
    }
}
		
    mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Awsome Company</title>
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
$con = mysqli_connect("localhost","root","","hrm");
$sql = "select * from supervisior where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                $_SESSION['supervisiorname']=$row["name"];
                echo "<i style='font-size: 14px; color: white;'>".$row["s_idd"]."</i>"."<br />"; 
            ?>
         <a href="supervisioreditprofile.php"<?php  $_SESSION['customerid']=$row["s_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="Sprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR DELETE STAFFS</a></li>
            <li><a href="addstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD EMPLOYEE</a></li>
            <li><a href="viewannoucement.php"><i class='fas fa-business-time' style='font-size:20px'></i>PREVIOUS LEAVE</a></li>
            <li><a href="addviewleavetype.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE LEAVE TYPE</a></li>
            <li><a href="addviewworkweek.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE WORK WEEK</a></li>
            <li><a href="addvieweducation.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE EDUCATION</a></li>
            <li><a href="addviewskills.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE SKILLS</a></li>
            <li><a href="addviewjobtitles.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE JOB TITLE</a></li>
            <li><a href="holiday.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE HOLIDAY</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div>   
<body>
    <button class="open-button" onclick="openForm()">ADD </button>

<div class="form-popup" id="myForm">
  <form action="addvieweducation.php" class="form-container" method="POST" enctype="multipart/form-data">

    <label for="text"><b>ADD NEW LEVEL</b></label>
    <input type="text" placeholder="level Name" name="name" required>

    <input type="submit" name="add"  value="add">
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
<body>
<div style="margin-left:20%">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Level</th>
											<th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>    
									<?php
                $con = mysqli_connect("localhost","root","","hrm");
    
                $sql = "select * from education order by e_id ";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $row["name"];
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                           <a href="addvieweducation.php?del=<?php echo $row["e_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
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
                    echo "There is no LEVEl is added yet.";
                }
                mysqli_close($con);
            ?>                     
                                        
                                    </tbody>
                                </table>
</div>
                  
</body>
</html>
<?php


if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    $con = mysqli_connect("localhost","root","","hrm");
    
    $sql = "Delete from education where e_id=$id";
    
    $query = mysqli_query($con,$sql);
     if($query){
        echo "<script type='text/javascript'> alert('Education is deleted')</script>";
        echo '<script>window.location="addvieweducation.php"</script>';
    }
    else{
        echo mysqli_error($con);
    }
    
}
?>