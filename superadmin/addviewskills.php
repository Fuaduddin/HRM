<?php
session_start();
$con = mysqli_connect("localhost","root","","hrm");
if(isset($_POST['add'])){
    $name = $_POST["name"];
    $desc = $_POST["descrip"];
    $exit= "SELECT * FROM `skills` WHERE  name ='$name'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
   {
      echo '<script>alert(" skill is already exist")</script>';
 }
    else{
       
          $c = "INSERT INTO `skills`(`name`,`description`) VALUES ('$name','$desc')";
          $query2 = mysqli_query($con,$c);
            echo '<script>alert("New Skill is added ")</script>';
		
    }
}
		
    mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Awosome Company</title> 
</head>
<body>
    <button class="open-button" onclick="openForm()">ADD </button>

<div class="form-popup" id="myForm">
  <form action="addviewskills.php" class="form-container" method="POST" enctype="multipart/form-data">

    <label for="text"><b>ADD NEW SKill</b></label>
    <input type="text" placeholder="Skill Name" name="name" required>
    <input type="text" placeholder="Skill Description" name="descrip" required>

    <input type="submit" name="add"  value="add">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<body>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Skill</th>
                                            <th>Description</th>
											<th>Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>    
									<?php
                $con = mysqli_connect("localhost","root","","hrm");
    
                $sql = "select * from skills order by s_id ";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $row["name"];
                                        echo "</td>";
                                    echo "<td>";
                                            echo $row["description"];
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                           <a href="addviewskills.php?del=<?php echo $row["s_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                            <?php
                                        echo "</td>";
                                    
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                }
                else
                {
                    echo "There is no Skill is added yet.";
                }
                mysqli_close($con);
            ?>                     
                                        
                                    </tbody>
                                </table>
                  
</body>
</html>
<?php


if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    $con = mysqli_connect("localhost","root","","hrm");
    
    $sql = "Delete from skills where s_id=$id";
    
    $query = mysqli_query($con,$sql);
     if($query){
        echo "<script type='text/javascript'> alert('Skill is deleted')</script>";
        echo '<script>window.location="addviewskills.php"</script>';
    }
    else{
        echo mysqli_error($con);
    }
    
}
?>