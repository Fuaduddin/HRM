<!DOCTYPE html>
<html>

<head>
    <title>Your Awosome Company</title>
</head>
<body>
<div id="result" style="padding-left: 140px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 85%;">
                <thead class="bg-light">
                    <tr>

                        <th>Supervisior ID</th>
                        <th>Supervisior </th>
                        <th>Contact Information</th>
                        <th>Official Information</th>
                        <th>User Name & Password </th>
                        <th>Total Leave</th>
                        <th>Total Salary</th>
                        <th>Delete</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect("localhost","root","","hrm");
                          if(isset($_POST["search"]))
                {
                 $search = $_POST["search"];
                 $query = " SELECT * FROM supervisior WHERE `name` LIKE '%".$search."%'  OR `phone` LIKE '%".$search."%' OR `email` LIKE '%".$search."%' OR `s_idd` LIKE '%".$search."%' OR `jobcategory` LIKE '%".$search."%' OR `jobtitle` LIKE '%".$search."%'";
                $result = mysqli_query($con,$query);
               if(mysqli_num_rows ($result) > 0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td>
                          
                                     <td> <?php echo $row["s_id"]; $_SESSION["supervisiorid"]= $row["s_id"];?>>
                                     
                                             echo $row["s_idd"] ;
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
                                 <td>
                                     Post: <?php 
                                     echo $row["jobtitle"];   ?>
                                     <br/>
                                      Job Category:
                                      <?php      
                                      echo $row["jobcategory"];
                          ?>
                                 </td>
                                 <td > User Name: <?php echo $row["user"] ;?> <br/>
                                 Password: <?php     echo $row["password"] ;?>
                                 </td>
                                 <td>
                                     <?php echo $row["tleave"];?>
                                 </td>
                                 <td>
                                     <?php
                                     echo $row["salary"];
                                         
                             ?>
                                 </td>
                                  <td><a href="viewadmin.php?del=<?php echo $row["s_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                                   <td><a href="updatestaffinfo.php?edi=<?php echo  $row["s_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>
         
                             </tr>
                             <?php
                                         }
                         }
                        }
    
            ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>

</html>
