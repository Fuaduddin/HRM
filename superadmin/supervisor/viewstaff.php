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
$con = mysqli_connect("localhost","root","","hrm");
$sql = "select * from supervisior where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                $_SESSION['supervisiorname']=$row["name"];
                echo "<i style='font-size: 14px; color: white;'>".$row["s_idd"]."</i>"."<br />"; 
            ?>
         <a href="supervisioreditprofile.php"<?php  $_SESSION['customerid']=$row["s_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="Sprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR DELETE STAFFS</a></li>
            <li><a href="addstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD EMPLOYEE</a></li>
            <li><a href="viewannoucement.php"><i class='fas fa-business-time' style='font-size:20px'></i>PREVIOUS LEAVE</a></li>
            <li><a href="addviewleavetype.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE LEAVE TYPE</a></li>
            <li><a href="addviewworkweek.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE WORK WEEK</a></li>
            <li><a href="addvieweducation.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE EDUCATION</a></li>
            <li><a href="addviewskills.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE SKILLS</a></li>
            <li><a href="addviewjobtitles.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE JOB TITLE</a></li>
            <li><a href="holiday.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD OR UPDATE HOLIDAY</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div>      
<div class="container" style=" align-content: center; padding-top:40px;">
   <br />
    <div style="padding-left: 180px;">
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text"  id="search"  placeholder="Search ....." class="form-control" />
    </div>
   </div>
    </div>
   <br />
   <div id="result" style="padding-left: 140px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 85%;">
                <thead class="bg-light">
                    <tr>

                        <th>Staff ID</th>
                        <th>Staff</th>
                        <th>Contact Information</th>
                        <th>Official Information</th>
                        <th>User Name & Password </th>
                        <th>Total Leave</th>
                        <th>Total Salary</th>
                        <th>Delete</th>
                        <th>Update</th>
                        <th>Assign Leave</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $name=$_SESSION['supervisiorname'];
                                        $con = mysqli_connect("localhost","root","","hrm");
                                        
                  $sql = "select * from `employee` where supervisior='$name' order by name ";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                    <td <?php echo $row["e_id"]; $_SESSION["staffid"]= $row["e_id"];?>>
                            <?php  
                                    echo $row["e_idd"] ;
                                    ?>
                           </td>
                        <td> <img src="<?php echo 'imgs/' . $row['image'] ?>" class="rounded-circle" alt='' style="width: 110px; height: 100px">
                           Name: <?php echo $row["name"]; ?> <br/>
                            Gender: <?php echo $row["gender"];?>
                        </td>
                        <td> Address:<?php echo $row["address"];?> <br/>
                           Phone Number: <?php echo $row["phone"];?> <br/>
                            email: <?php echo $row["email"];?>
                        </td>
                        <td> Supervisior: <?php echo $row["supervisor"];?> <br/>
                            Post: <?php echo  $row["jobtitle"];?><br/>
                             Job Category:<?php  echo $row["jobcategory"];?>
                        </td>
                        <td > User Name: <?php echo $row["user"] ;?> <br/>
                        Password: <?php     echo $row["password"] ;?>
                        </td>
                        <td>
                            <?php echo $row["t_leave"];?>
                        </td>
                        <td>
                            <?php echo $row["salary"];?>
                        </td>
                         <td><a href="viewstaff.php?del=<?php echo $row["e_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="updatestaffinfo.php?edi=<?php echo  $row["e_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>
                          <td><a href="addleave.php?edi=<?php echo  $row["e_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Assign Leave</a></td>
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
        <script>
         $(document).ready(function() {
            $('#search').keyup(function() {
                var search = $(this).val();
               var output=console.log(search.lenght);
                if ( output != 0) {
                    $.ajax({
                        url: "staffsearch.php",
                        method: "POST",
                        data: {
                            search: search
                        },
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                }
                else
                    {
                       document.getElementById("result").innerHTML="";
                    }
            });
        });
    </script>
<?php
     $con = mysqli_connect("localhost","root","","hrm");
    if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $sql1 = "select user from `employee` where e_id= '$id'";
    $query = mysqli_query($con,$sql1); 
    $row = mysqli_fetch_assoc($query);
        $user=$row["user"];
        if($quiery)
        {
            $sql2 = "Delete from `employee` where user= '$user'";
    $sql3 = "Delete from user where user=$user";
    $query2 = mysqli_query($con,$sql2);
    $query3 = mysqli_query($con,$sql3);
         if($query3 && $query2 ){
        echo "<script type='text/javascript'> alert('Staff is deleted')</script>";
        echo '<script>window.location="viewstaff.php"</script>';
    }
        }
     else{
        echo "<script type='text/javascript'> alert('Error while deleting the Staff')</script>";
        echo '<script>window.location="viewstaff.php"</script>';
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
</body>

</html>