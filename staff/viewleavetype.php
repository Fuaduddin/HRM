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
        // $un ="fuad";
$con = mysqli_connect("localhost","root","","hrm");
$sql = "select * from employee where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                echo "<i style='font-size: 14px; color: white;'>".$row["e_idd"]."</i>"."<br />"; 
            ?>
         <a href="customereditprofile.php"<?php  $_SESSION['customerid']=$row["e_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="cprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="viewcustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>Holidays</a></li>
            <li><a href="viewleavetype.php"><i class='fas fa-business-time' style='font-size:20px'></i>Leave type</a></li>
            <li><a href="viewleave.php"><i class='fas fa-business-time' style='font-size:20px'></i>Your Leave List</a></li>
             <li><a href="viewworkweek.php"><i class='fas fa-business-time' style='font-size:20px'></i> WORK WEEEK</a></li>
               <li><a href="addleave.php"><i class='fas fa-business-time' style='font-size:20px'></i>APPLY LEAVE</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
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
</body>
</html>