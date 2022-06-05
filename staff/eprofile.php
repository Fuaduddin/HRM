<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
      
    <title>Your Awsome Company</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="profile.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
</div>     
    <div class="header">                  
    <h1 class="page-header">
                    <?php
                    echo "<p style=' font-size: 20px; text-align: center; padding-top: 100px; color: black;'>"."Hi "."<i>".$row["name"]."</i>"." Welcome </p>";
                ?>
                        </h1>
                   </div>    
    <div class='card mb-3 container' style='margin-top: 30px; padding-left: 15px;'>
          <h1 style="text-align: center;">Pending Leave </h1>
         <div style="padding-left:200px;">
     <div class="container">
 <table  class="table table-bordered" style="width: 80%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Description</th>
											<th>Leave From</th>
                                            <th>Leave From</th>
                                            <th>Apply Date</th>
											<th>Update</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
            									<?php
                                        $un = $_SESSION['username'];
                
                                        $con = mysqli_connect("localhost","root","","hrm");
                                        $sql = "select * from `employee` where user = '$un' limit 1";       
                                        $query = mysqli_query($con,$sql); 
                                        $row = mysqli_fetch_assoc($query);
                                       $e_id= $row['e_idd']   ; 
                                       $sql1 = "select * from `leavelist` where  l_update= 0 and e_id='$e_id'";//ORDER BY id desc
            $result = mysqli_query($con, $sql1);
                if(mysqli_num_rows($result)>0)
                {
                              while($row = mysqli_fetch_assoc($result))
                                {
                                        echo "<td>";
                                            echo $row["product"];
                                        echo "</td>";
                                  echo "<td>";
                                            echo "Name: ".$row["c_name"]."<br\>";
                                  echo "Phone Number: ".$row["c_phone"]."<br\>";
                                  echo "Email: ".$row["c_email"]."<br\>";
                                  
                                        echo "</td>";
                                    echo "<td>";
                                            echo $row["subject"];
                                        echo "</td>";
                                    echo "<td>";
                                            echo $row["details"]."<br />";  
                                        echo "</td>";
                                  echo "<td>";
                                            echo $row["piroty"]."<br />";
                                        echo "</td>";
                                  echo "<td>";
                                            ?>
                                            <a href="updateappointment.php?edi=<?php echo $row["id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a>
                                            <?php
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                }
                mysqli_close($con);
            ?>
     </tbody>
         </table>
        </div> 
        </div>
    </div>
</body>
</html>
