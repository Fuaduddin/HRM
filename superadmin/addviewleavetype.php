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
    <button class="open-button" onclick="openForm()">Open Form</button>

<div class="form-popup" id="myForm">
  <form  action="addviewleavetype.php" method="post"  enctype="multipart/form-data" class="form-container">
    <h1>Add Leave Types</h1>

    <label for="email"><b>Type</b></label>
    <input type="text" name="type" class="add" placeholder=" ADD NEW Leave Type" required> <br/>

    <label for="psw"><b>No days</b></label>
    <input type="text"  name="day" placeholder="Enter Total Day" required>

    <button type="submit" name="submit" class="btn">Add</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
    <?php
    if(isset($_POST['submit']))
    {
      $con = mysqli_connect("localhost","root","","hrm");
        $type=$_POST["type"];
        $day=$_POST["day"];
        $sql= "INSERT INTO `leavet` (`types`,`nodays`) VALUES ('$type','$day') ";
        $query= mysqli_query($con,$sql);
        if($query)
        {
          echo "<script type='text/javascript'> alert('New Leave type is added')</script>";
          echo '<script>window.location="addviewleavetype.php"</script>';  
        }
        else
        {
            echo "<script type='text/javascript'> alert('Error While Adding New leave type')</script>";
            echo '<script>window.location="addviewleavetype.php"</script>'; 
        }
    }
    ?>
    <center>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
    <div class="container" style=" align-content: center; padding-top:40px;">
   <div id="result" style="padding-left: 150px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 90%;padding-left:20%;">
                <thead class="bg-light">
                    <tr>

                        <th>No</th>
                        <th>Types</th>
                        <th>Duration of leave</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
 $con = mysqli_connect("localhost","root","","hrm");
 $sql = "select * from leavet order by types ASC";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
             $i="1";
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                ?>
                    <tr>
                        <td><?php echo $i ; ?></td>
                         <td><?php echo $row["types"];?></td>
                        <td><?php echo $row["nodays"];?></td>
                 <td>
                    <a href="addviewleavetype.php?del=<?php echo $row["l_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                        </td>
                        <?php
                                  $i++;  
         }
         }
                                        ?>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
    </center>
        <?php
    if(isset($_GET["del"]))
    {
        $con = mysqli_connect("localhost","root","","hrm");
        $id=$_GET["del"];
        $sql="Delete from leavet where l_id='$id'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
             echo "<script type='text/javascript'> alert(' Leave Type is Deleted')</script>";
            echo '<script>window.location="addviewleavetype.php"</script>'; 
        }
        else
        {
             echo "<script type='text/javascript'> alert('Error While Deleting Leave type')</script>";
            echo '<script>window.location="addviewleavetype.php"</script>'; 
        }
    }
    ?>
</body>
</html>