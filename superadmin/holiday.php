<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your Awosome Company</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="popupmodal.css">
     
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
            <li><a href="Sprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="updatecustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD STAFFS</a></li>
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD PAYGRADE</a></li>
            <li><a href="viewproductcategory.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD WORKING ITEM</a></li>
            <li><a href="viewaproduct.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD LEAVE</a></li>
            <li><a href="viewannoucement.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD JOB DETAILS</a></li>
            <li><a href="viewcustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD REQUIERMENT</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div>
    <div style="margin-left:20%;">
         <div class="modal-content">
   <form action="holiday.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h3>ADD NEW Holiday</h3>
    <label><b>Date</b></label><br/>
    <input type="date" placeholder="New Date" name="date" required> <br \>
    <label><b>Day</b></label><br/>
    <input type="text" placeholder="Day" name="day" required> <br \> 
    <label><b>Holiday</b></label><br/>
    <input type="text" placeholder="Holiday" name="holiday" required> <br \> 
    <label><b>Total Amount of days off</b></label><br/>
    <input type="text" placeholder="Holiday" name="off" required> <br \> 
        <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="btn">Cancel</button>
        <button type="submit" name="add" class="btn">ADD</button>
      </form>
  </div>
    </div>
<div class="container" style=" align-content: center; padding-top:40px;">
   <div id="result" style="padding-left: 150px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 90%;">
                <thead class="bg-light">
                    <tr>

                        <th>Date</th>
                        <th>Day</th>
                        <th>Holiday</th>
                        <th>Total Holidays</th>
                        <th>Delete</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $con = mysqli_connect("localhost","root","","hrm");
                                        
                  $sql = "select * from `holidays` order by date ASC";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td ><?php echo $row["date"];?> </td>
                        <td> <?php echo $row["days"];?> </td>
                        <td> <?php echo $row["h_name"];?></td>
                        <td> <?php echo $row["aoffday"];?></td>
                        <td><a href="holiday.php?del=<?php echo $row["h_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><button   class="btn btn-primary" <?php $_SESSION["holidayid"] = $row["h_id"] ?> onclick="openForm()">UPDATE</button></td>

                    </tr>
                    <?php
                                }
                }
    
            ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
  <?php 
$con = mysqli_connect("localhost","root","","hrm");
$id2=$_SESSION["holidayid"];
$sql = "select * from holidays where h_id=$id2";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0 )
{                          
  while($row = mysqli_fetch_assoc($result))
  {
    $date=$row["date"];
    $days=$row["days"];
    $h_name=$row["h_name"];
    $aoffday=$row["aoffday"];
  }
}
?>
<div class="form-popup" id="myForm">
<form action="holiday.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h3>ADD NEW Holiday</h3>
    <label><b>Date</b></label><br/>
    <input type="text" placeholder="<?php echo $date?>" readonly><br \>
    <input type="date" class="date" placeholder="New Date" name="date"> <br \>
    <label><b>Day</b></label><br/>
    <input type="text" placeholder="<?php echo $days?>" readonly><br \>
    <input type="text" placeholder="Day" name="day"> <br \> 
    <label><b>Holiday</b></label><br/>
    <input type="text" placeholder="<?php echo $h_name?>" readonly><br \>
    <input type="text" placeholder="Holiday" name="holiday" > <br \> 
    <label><b>Total Amount of days off</b></label><br/>
    <input type="text" placeholder="<?php echo $aoffday?>" readonly><br \>
    <input type="text" placeholder="Holiday" name="off"> <br \> 

    <button type="update" class="btn">UPDATE</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
  <?php
if(isset($_POST['update'])){
  $con = mysqli_connect("localhost","root","","hrm");
  $id4=$_SESSION["holidayid"];
    $grade = $_POST["date"];
    $currency = $_POST["day"];
    $msalary = $_POST["holiday"];
    $off = $_POST["off"];

    if($grade !=='')
    {
$sql1= "UPDATE `holiday` SET `date`='$grade'  WHERE h_id='$id4'";
$query1 = mysqli_query($con,$sql1);
if($query1){
     echo '<script>alert("Your Account have been updated")</script>';
     echo '<script>window.location="holiday.php"</script>';
}
         else{
           echo '<script>alert("Error while updating profile")</script>';
        }
    }
           
    if($currency !=='')
    {
$sql1= "UPDATE `holiday` SET `days`='$currency'  WHERE h_id='$id4'";
$query1 = mysqli_query($con,$sql1);
if($query1){
     echo '<script>alert("Your Account have been updated")</script>';
     echo '<script>window.location="holiday.php"</script>';
}
         else{
           echo '<script>alert("Error while updating profile")</script>';
        }
    }
    if($msalary !=='')
    {
$sql1= "UPDATE `holiday` SET `h_name`='$msalary'  WHERE h_id='$id4'";
$query1 = mysqli_query($con,$sql1);
if($query1){
     echo '<script>alert("Your Account have been updated")</script>';
     echo '<script>window.location="holiday.php"</script>';
}
         else{
           echo '<script>alert("Error while updating profile")</script>';
        }
    }          
    if($off !=='')
    {
$sql1= "UPDATE `holiday` SET `aoffday`='$off'  WHERE h_id='$id4'";
$query1 = mysqli_query($con,$sql1);
if($query1){
     echo '<script>alert("Your Account have been updated")</script>';
     echo '<script>window.location="holiday.php"</script>';
}
         else{
           echo '<script>alert("Error while updating profile")</script>';
        }
    }  
}

mysqli_close($con);
?>
</div>

<script> 
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script> 
<?php
$con = mysqli_connect("localhost","root","","hrm");
if(isset($_POST['add'])){
    $grade = $_POST["date"];
    $currency = $_POST["day"];
    $msalary = $_POST["holiday"];
    $off = $_POST["off"];
          $c = "INSERT INTO `holidays`(`date`,`days`,`h_name`,`aoffday`) VALUES ('$grade','$currency','$msalary','$off')";
          $query2 = mysqli_query($con,$c);
            echo '<script>alert("New Holiday  is added ")</script>';
        echo '<script>window.location="holiday.php"</script>';
		
    }
		
    mysqli_close($con);
?>
<?php


if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    $con = mysqli_connect("localhost","root","","hrm");
    
    $sql = "Delete from holidays where h_id=$id";
    
    $query = mysqli_query($con,$sql);
     if($query){
        echo "<script type='text/javascript'> alert('Holiday is deleted')</script>";
        echo '<script>window.location="holiday.php"</script>';
    }
    else{
        echo mysqli_error($con);
    }
    
}
?>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</script>

</body>

</html>