<?php
session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","hrm");
 $id = $_SESSION['customerid'];
if(isset($_POST['submit'])){
    $namei = $_POST["namei"];
    $name = $_POST["name"];
    $details = $_POST["details"];
    $category= $_POST["category"];
    $categoryl=$_POST["categoryl"];
    $fdate= $_POST["fdate"];
    $tdate=$_POST["tdate"];
    $total=$_POST["total"];
  
        if($name!=='')
        {
    $sql1= "UPDATE `leavelist` SET `name`='$name' WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your product have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
        if($namei!=='')
        {
    $sql1= "UPDATE `leavelist` SET  `e_id`='$namei'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your product have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
          if($categoryl!=='')
        {
            $sql1= "UPDATE `leavelist` SET  `leavet`='$categoryl'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
        if($category!==1)
        {
            $con = mysqli_connect("localhost","root","","hrm");
            $id=1;
            $sql1= "Select * from `leavelist` where le_id= '$id' limit 1";
            $query1 = mysqli_query($con,$sql1);
            while($row = mysqli_fetch_assoc($query1))
            {
            $name = $row["e_id"];
            }
            $sql1= "Select * from `employee` where e_idd= '$name' limit 1";
            $query1 = mysqli_query($con,$sql1);
            while($row = mysqli_fetch_assoc($query1))
            {
            $tleave = $row["t_leave"];
            }
            $tleave=$tleave-$total;
            $sql1= "UPDATE `employee` SET  `t_leave`='$tleave'   WHERE e_id='$id'";
           $query1 = mysqli_query($con,$sql1);
        }
        if($total!==1)
        {
            $sql1= "UPDATE `leavelist` SET  `totalle`='$total'   WHERE le_id='$id'";
            $query1 = mysqli_query($con,$sql1);
            if($query1){
                 echo '<script>alert("Your Account have been updated")</script>';
                header('location:spofile.php');  
            }
                     else{
                       echo '<script>alert("Error while updating product")</script>';
                    }
        }
                if($category!=='')
        {
            $sql1= "UPDATE `leavelist` SET  `l_update`='$category'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
               
                if($details!=='')
        {
            $sql1= "UPDATE `leavelist` SET  `details`='$details'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
        if($fdate!=='')
        {
            $sql1= "UPDATE `leavelist` SET  `d_form`='$fdate'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
        if($tdate!=='')
        {
            $sql1= "UPDATE `leavelist` SET  `d_to`='$tdate'   WHERE le_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:spofile.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }

 
      
               
        }
		
    mysqli_close($con);
?>
<?php
    $con = mysqli_connect("localhost","root","","hrm");
    $id=1;
    $sql1= "Select * from `leavelist` where le_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $name = $row["e_id"];
    $e_name = $row["e_name"];
    $details= $row["details"];
    $category = $row["leavet"];
    $d_form = $row["d_from"];
    $d_to= $row["d_to"];
    $ae_id= $row["ae_id"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Your Awesome Company </title>
       <link rel="stylesheet" href="css\login.css">
    </head>
    <body>
        <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <div class="container">
                <div class="form-popup" id="myForm">
    <form  class="form-container"  method="POST" action="updateleave.php" enctype="multipart/form-data">
    <label><b>Employee ID</b></label><br/>
            <input name="namei" type="text" class="form-login"  placeholder="<?php  echo $name; ?>" ><br />
            <label><b>Leave Balance</b></label><br/>
            <input name="t_leave" type="text" class="form-login"  placeholder="<?php  
            $ae_id= $row["ae_id"];
            $id=1;
            $sql1= "Select * from `leavelist` where le_id= '$id' limit 1";
            $query1 = mysqli_query($con,$sql1);
            while($row = mysqli_fetch_assoc($query1))
            {
            $name = $row["e_id"];
            $e_name = $row["e_name"];
            $details= $row["details"];
            $category = $row["leavet"];
            $d_form = $row["d_from"];
            $d_to= $row["d_to"];
            $ae_id= $row["ae_id"];
            $total= $row["totalle"];
            }
           echo $e_name; ?>" ><br />
            <label><b>Employee Name</b></label><br/>
            <input name="name" type="text" class="form-login"  placeholder="<?php  echo $e_name; ?>" ><br />
            <label>Leave Type </label><br/>
            <select name="categoryl" class="form-control" >
                <option value="" > <?php    $category ;
                   $con = mysqli_connect("localhost","root","","hrm");
     
                   $sql2 = "SELECT * FROM `leavet` where  l_id='$category'";//ORDER BY id desc
                   $te = mysqli_query($con,$sql2);
       
                  while($row=mysqli_fetch_array($te))
                   {    $type=$row['types'];
                 
                      echo $type;
                    }?>
                 </option>
                <?php
                   $con = mysqli_connect("localhost","root","","hrm");
     
                  $sql2 = "SELECT * FROM `leavet` order by types";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $type=$row['types'];
                    $typel=$row['l_id'];
                
                     echo "<option value='$typel' > $type </option>";
                
                 }?>
            </select> <br/>
            <label><b>From </b></label><br/>
            <input type="text" class="form-login"  placeholder="<?php  echo $d_form; ?>" disabled>
            <input name="tdate" type="date" class="form-login" ><br />
            <label><b>To </b></label><br/>
            <input type="text" class="form-login"  placeholder="<?php  echo $d_to; ?>" disabled>
            <input name="tdate" type="date" class="form-login"  ><br />
            <label><b>Total Leave</b></label><br/>
            <input type="number" class="form-login" name="total"  placeholder="<?php  echo $total; ?>" >
            <label><b>Comments </b></label><br/>
            <textarea name="details" placeholder="<?php  echo $details; ?>"></textarea><br />
            <label>Assigned </label><br/>
            <select name="category" class="form-control" >
                <option > Select</option>
                <option value="1" > Approved</option>
                <option value="2" > Cancel</option>
            </select> <br/>
        <input type="submit" name="submit" class="form-login submit" value="Update">
               <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="cprofile.php" style="color: white">HOME</a></p>
        </form>
</div>

            </div>
        </div>
    </body>
</html>