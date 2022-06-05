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
   <form action="paygrade.php" class="form-container" method="POST" enctype="multipart/form-data">
    <h3>ADD NEW Pay Grade</h3>
    <input type="text" placeholder="New Grade" name="grade" required> <br \>
    <input type="text" placeholder="Currency" name="currency" required> <br \>
    <input type="text" placeholder="Min Salary" name="msalary" required> <br \>
    <input type="text" placeholder="Max Salary" name="masalary" required> <br \>
          
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

                        <th>Grade No</th>
                        <th>Curency</th>
                        <th> Salary</th>
                        <th>Delete</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $con = mysqli_connect("localhost","root","","hrm");
                                        
                  $sql = "select * from `paygrade` order by grade ASC";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td ><?php echo $row["grade"];?> </td>
                        <td> <?php echo $row["currency"];?> </td>
                        <td> <?php echo $row["msalary"];?></td>

                         <td><a href="paygrade.php?del=<?php echo $row["p_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="paygrade.php?edi=<?php echo  $row["p_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

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
if(isset($_POST['add'])){
    $grade = $_POST["grade"];
    $currency = $_POST["currency"];
    $msalary = $_POST["msalary"];
    $masalary = $_POST["masalary"];
    $exit= "SELECT * FROM `paygrade` WHERE  grade='$grade'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
   {
      echo '<script>alert(" Pay Grade is already exist")</script>';
        echo '<script>window.location="paygrade.php"</script>';
 }
    else{
       
          $c = "INSERT INTO `paygrade`(`grade`,`currency`,`msalary`,`masalary`) VALUES ('$grade','$currency','$msalary','$masalary')";
          $query2 = mysqli_query($con,$c);
            echo '<script>alert("New Pay Grade  is added ")</script>';
        echo '<script>window.location="paygrade.php"</script>';
		
    }
}
		
    mysqli_close($con);
?>
<?php


if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    $con = mysqli_connect("localhost","root","","hrm");
    
    $sql = "Delete from paygrade where p_id=$id";
    
    $query = mysqli_query($con,$sql);
     if($query){
        echo "<script type='text/javascript'> alert('Pay Grade is deleted')</script>";
        echo '<script>window.location="paygrade.php"</script>';
    }
    else{
        echo mysqli_error($con);
    }
    
}
?>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>

</html>