<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Your Awsome Company </title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
         <div class="login-title">
            <h1 style="font-size: 18px; font-family: cursive; color:black; text-align: center; ">Login</h1>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="login.php">
                <input name="user" type="text" class="form-login" placeholder="User Name" required><br />
                <input name="password" type="password" class="form-login" placeholder="Password" required><br />
                
                <input type="submit" name="submit" class="form-login submit" value="Login"><br />
            </form>
            <p style="text-align: right; font-size: 18px; font-family: cursive; color:black; text-align: center; "><a href="changepass.php" style="color:black; text-align: center;">Forgetten Password ?</a></p>
        </div>
    <?php
   $con = mysqli_connect("localhost","root","","hrm");
   if(isset($_POST['submit'])){
		 $user = $_POST['user'];
		 $password = $_POST['password'];
         $sql1 = "SELECT password FROM `user` WHERE user = '$user' AND type = '$password'limit 1 ";
         $query1 = mysqli_query($con, $sql1);
         while($row1 = mysqli_fetch_assoc($query1))
        {
           $type = $row1["password"];
             if ($type == 'staff') {
                    $_SESSION['username'] = $user ;
					header('location:http://localhost/HRM/staff/eprofile.php');		  
			}
			elseif($type == 'supervisior'){
                   $_SESSION['username'] = $user ;
					header('location:http://localhost/HRM/supervisor/sprofile.php');
			}
            elseif($type== 'superadmin'){
                   $_SESSION['username'] = $user ;
					header('location:http://localhost/HRM/superadmin/spprofile.php');
			}
		 	else {
             echo '<script>alert("Your password or email is wrong")</script>';
             header('location:login.php');
            }
             }
        }
                 
?>

           </body>
</html>