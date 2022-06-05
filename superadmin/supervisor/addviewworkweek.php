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
<form action="addviewworkweek.php" method="post"  enctype="multipart/form-data">
    <label> ADD New Work Week </label><br/>
    <input type="text" name="work" class="add" placeholder=" ADD NEW Work Week" required> <br/>
    <label for="cars">Choose a Shifts:</label> <br/>
    <select name="shift" id="cars" required>
        <option value="1">Full Day</option>
        <option value="2"> Half Day</option>
        <option value="3">Holiday Day</option>
    </select><br/>
    <button class="btn btn-primary" name="submit"> ADD</button>
</form>
<?php
    if(isset($_POST['submit']))
    {
      $con = mysqli_connect("localhost","root","","hrm");
        $work=$_POST["work"];
        $shift=$_POST["shift"];
        $sql= "INSERT INTO `workweek` (`days`,`shifts`) VALUES ('$work','$shift') ";
        $query= mysqli_query($con,$sql);
        if($query)
        {
          echo "<script type='text/javascript'> alert('New Work Day is added')</script>";
          echo '<script>window.location="addviewworkweek.php"</script>';  
        }
        else
        {
            echo "<script type='text/javascript'> alert('Error While Adding New Work Week')</script>";
            echo '<script>window.location="addviewworkweek.php"</script>'; 
        }
    }
    ?>
    <div style="margin-left:20%">
<table class="table table-striped table-bordered table-hover w-75" id="dataTables-example">
    <thead>
        <tr>
             <th> NO </th>
            <th> Days </th>
            <th> Shifts </th>
            <th> Delete</th>
        </tr>  
    </thead>
    <tbody>
         <?php
                $con = mysqli_connect("localhost","root","","hrm");
                $i=1;
                $sql = "select * from workweek order by days ASC ";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $i;
                                        echo "</td>";
                                      echo "<td>";
                                            echo $row["days"];
                                        echo "</td>";
                                    echo "<td>";
                                    if($row["shifts"]=='1')
                                    {
                                        echo "Full Day";
                                    }
                                    elseif($row["days"]=='2')
                                    {
                                        echo "Half Day";
                                    }
                                    else
                                    {
                                        echo "Holiday Day";
                                    }
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                           <a href="addviewworkweek.php?del=<?php echo $row["w_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                            <?php
                                        echo "</td>";
                                    
                                    echo "</tr>";
                                    $i++;
                                }
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
    <?php
    if(isset($_GET["del"]))
    {
        $con = mysqli_connect("localhost","root","","hrm");
        $id=$_GET["del"];
        $sql="Delete from workweek where w_id='$id'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
             echo "<script type='text/javascript'> alert(' Work Day is Deleted')</script>";
            echo '<script>window.location="addviewworkweek.php"</script>'; 
        }
        else
        {
             echo "<script type='text/javascript'> alert('Error While Deleting Work Day')</script>";
            echo '<script>window.location="addviewworkweek.php"</script>'; 
        }
    }
    ?>
</body>
</html>