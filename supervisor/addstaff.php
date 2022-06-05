<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="form.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Your Awosome Company</title>
  </head>
  <body>
  <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <div class="container">
            <form class="form-container" method="POST" action="addstaff.php" enctype="multipart/form-data">
                        <label><b>Employee Name</b></label><br/>
                        <input name="name" type="text" class="form-login" placeholder="Full Name" required><br />
                        <label><b>Employee Email</b></label><br/>
                        <input name="email" type="text" class="form-login" placeholder="E-mail" required><br />
                        <label><b>Employee Phone Number</b></label><br/>
                        <input name="phone" type="text" class="form-login" placeholder="Phone Number" required><br />
                        <label><b>Employee Address</b></label><br/>
                        <textarea name="address" class="form-login" placeholder="Address" row="10" required></textarea><br />
                        <label><b>Gender</b></label> <br />
                        <input type="radio" class="form-login" value="male" name="gender"> Male 
                        <input type="radio" value="female" name="gender"> Female <br />
                        <label><b>Employee User ID</b></label><br/>
                        <input name="user" type="text" class="form-login" placeholder="User Name" required><br />
                        <label><b>Employee Password</b></label><br/>
                        <input name="password" type="text" class="form-login" placeholder="Password" required><br />
                        <label><b>Job Title </b></label><br/>
                        <select name="jtitle" type="text"  class="form-login" required>
                            <option value selected></option>
                            <?php
                            $con = mysqli_connect("localhost","root","","hrm");
                            $sql2 = "SELECT * FROM `jobtitle` order by j_title ASC";//ORDER BY id ASC
                            $te = mysqli_query($con,$sql2);
                            while($row=mysqli_fetch_array($te))
                            {
                                $type=$row['j_title'];
                                echo "<option value='$type' > $type </option>";
                                }?>
                                </select><br/>
                                <label><b>Job category</b></label><br/>
                                <select name="category" type="text" class="form-login" required>
                                    <option value selected></option>
                                    <?php
                                    $con = mysqli_connect("localhost","root","","hrm");
                                    $sql2 = "SELECT * FROM `jobcategories` order by name";//ORDER BY id desc
                                    $te = mysqli_query($con,$sql2);
                                    while($row=mysqli_fetch_array($te))
                                    {
                                        $name=$row['name'];
                                        echo "<option value='$name' > $name </option>";
                                        }?>
                                        </select><br/>
                                        <label><b>Supervisior</b></label><br/>
                                        <select name="supervisior" type="text" class="form-login" required>
                                    <option value selected></option>
                                    <?php
                                    $con = mysqli_connect("localhost","root","","hrm");
                                    $sql2 = "SELECT * FROM `supervisior` order by name";//ORDER BY id desc
                                    $te = mysqli_query($con,$sql2);
                                    while($row=mysqli_fetch_array($te))
                                    {
                                        $name=$row['name'];
                                        echo "<option value='$name' > $name </option>";
                                        }?>
                                        </select><br/>
                                        <label><b>Salary</b></label><br/>
                                <select name="salary" type="text" class="form-login" required>
                                    <option value selected></option>
                                    <?php
                                    $con = mysqli_connect("localhost","root","","hrm");
                                    $sql2 = "SELECT * FROM `paygrade` order by grade ASC";//ORDER BY id desc
                                    $te = mysqli_query($con,$sql2);
                                    while($row=mysqli_fetch_array($te))
                                    {
                                        $name=$row['grade'];
                                        echo "<option value='$name' > $name </option>";
                                        }?>
                                        </select><br/>
                        <label><b>Total Leave</b></label><br/>
                        <input name="tleave" type="text" class="form-login" placeholder="12" ><br />
                        <label><b>Profile Picture</b></label>
                        <input type="file" alt="pro-pic" name="profilepic" class="form-control" required><br />
                        <input type="submit" name="submit" class="form-login submit" value="submit">
             <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="viewcustomer.php" style="color: white">HOME</a></p> 
                    </form>
                    <?php
          $con = mysqli_connect("localhost","root","","hrm");
if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"]; 
    $type = "staff";
    $user = $_POST["user"];
    $password = $_POST["password"];
    $tleave = "12";
    $jtitle= $_POST["jtitle"];
    $jcategory = $_POST["category"];
    $salary = $_POST["salary"];
    $supervisior = $_POST["supervisior"];
    $s_idd=bin2hex(random_bytes(8));
    $c = "INSERT INTO `employee` (`name`, `address`, `phone`, `email`,`image`, `gender`, `t_leave`, `jobtitle`,`user`,`password`, `jobcategory`,`salary`,`e_idd`,`supervisor`) VALUES ('$name','$address','$phone','$email','$imagename','$gender','$tleave','$jtitle','$user','$password','$jcategory','$salary','$s_idd','$supervisior')";
    $sql3 = "INSERT INTO `user`(`user`,`type`,`password`) VALUES ('$user','$password','$type')"; 
    $query2 = mysqli_query($con,$c);
    $query3 = mysqli_query($con,$sql3);
      if($query2 && $query3){
        echo '<script>alert("New Employee is added.")</script>';
        echo '<script>window.location="addstaff.php"</script>';
     }
    else
     {
        echo '<script>alert("ERROR!!!!")</script>';
        echo '<script>window.location="addstaff.php"</script>';
      }
}
?>
</div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>