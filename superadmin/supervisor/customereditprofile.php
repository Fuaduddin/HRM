<?php
session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","hrm");
//  $id = $_SESSION['customerid'];
$id =12;
if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"];
    $exit= "select * from user where user='$user'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
    {
       echo '<script>alert("An account is already exist")</script>';
    }
    else{
        if($name!=='')
        {
    $sql1= "UPDATE `supervisior` SET `name`='$name'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
          if($email!=='')
        {
    $sql1= "UPDATE `supervisior` SET `email`='$email'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                if($phone!=='')
        {
    $sql1= "UPDATE `supervisior` SET `phone`='$phone'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($user!=='')
        {
    $sql1= "UPDATE `supervisior` SET `user`='$user'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($password!=='')
        {
                    if($password == $cpassword)
                    {
                        
                    
    $sql1= "UPDATE `supervisior` SET `password`='$password'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                }
               
                if($imagename!=='')
        {
    $sql1= "UPDATE `supervisior`SET `image`='$imagename'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($address!=='')
        {
    $sql1= "UPDATE `supervisior` SET `address`='$address'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                 if($gender!=='')
        {
    $sql1= "UPDATE `supervisior` SET `gender`='$gender'  WHERE s_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:cpofile.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
               
		}
        }
		
    mysqli_close($con);
?>
<?php
    $con = mysqli_connect("localhost","root","","hrm");
    //  $id = $_SESSION['customerid'];
    $id =12;
    $sql1= "Select * from `supervisior` where s_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $user = $row["user"];
    $address = $row["address"];
    $password = $row["password"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Your Awesome Company </title>
       <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="customereditprofile.php" enctype="multipart/form-data">
                <input name="name" type="name" class="form-login" placeholder="<?php echo $name;?>"><br />
                <input name="email" type="email" class="form-login"  placeholder="<?php echo $email;?>"><br />
                <input name="phone" type="phone" class="form-login"  placeholder="<?php echo $phone;?>"><br />
                <input name="user" type="email/phone" class="form-login"  placeholder="<?php echo $user;?>"><br />
                <input name="address" type="address" class="form-login" placeholder="<?php echo $address;?>"><br />
                <input name="password" type="password" class="form-login" placeholder="<?php echo $password;?>"><br />
                <input name="cpassword" type="password" class="form-login" placeholder="Repeat Password"><br />
                <input type="radio" value="male" name="gender"  > Male
                <input type="radio" value="female" name="gender" > Female <br / >
                <input type="file" alt="pro-pic" name="profilepic" class="form-control"><br />
                <input type="submit" name="submit" class="form-login submit" value="Update">
                <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="cprofile.php" style="color: white">HOME</a></p>
            </form>
        </div>
    </body>
</html>