<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Your Awesome Company </title>
       <link rel="stylesheet" href="login.css">
    </head>
    <body>
    <?php 
         if(isset($_GET['edi'])){
            $id = $_GET['edi']; 
            $_SESSION['employeeid']=$id;
$con = mysqli_connect("localhost","root","","hrm");
$sql = "select * from `supervisior` where s_id = '$id' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="login-title">
            <h2 style="text-align:center;">Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <div class="container">
    <form class="modal-content"  method="POST" action="addleaves.php" enctype="multipart/form-data">
        <div class="container">
            <h1 style="text-align:center;">New Leave</h1>
            <label><b>Supervisior ID</b></label><br/>
            <input name="cname" type="text" class="form-login" value="<?php  echo $row["s_idd"]; ?>" required><br />
            <label><b>Employee Name </b></label><br/>
            <input name="cmail" type="text" class="form-login" value="<?php echo $row["name"]; ?>"  required><br />
            <label><b>Leave Balance </b></label><br/>
            <input name="cphone" type="text" class="form-login" value="<?php echo  $row["tleave"]; ?>" readonly><br />
            <label>Leave Type </label><br/>
            <select name="category" class="form-login" required>
                <option value selected></option>
                <?php
                   $con = mysqli_connect("localhost","root","","hrm");
     
                  $sql2 = "SELECT * FROM `leavet` order by types";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $type=$row['types'];
                   
                
                     echo "<option value='$type' > $type </option>";
                
                 }?>
            </select><br/>
            <label><b>Comment </b></label><br/>
            <textarea name="message" class="form-login" placeholder="Write your message" row="10" required></textarea><br />
            <label><b>From Date </b></label><br/>
            <input name="fdate" type="date" class="form-login" value="<?php echo $phone; ?>"  required><br />
            <label><b>To Date</b></label><br/>
            <input name="subject" type="date" class="form-login" placeholder="Subject" required><br />
            <label><b>Total Leave</b></label><br/>
            <input name="total" type="number" class="form-login" placeholder="Total Leave" required><br />
             <button  style="height:50px ;text-align: right; font-size: 18px; font-family: cursive; color:black; text-align: center; width:40%;" name="post" type="submit" class="signupbtn">Post</button>
        </div>
        <?php
         }
         ?>
        <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="sprofile.php" style="color: white">HOME</a></p>
        </form>
            <?php
if(isset($_POST['post'])){
    $con = mysqli_connect("localhost","root","","hrm");
    $id=$_SESSION['employeeid'];
    $sql = "select s_id from `supervisior` where s_id = '$id' limit 1";       
    $query = mysqli_query($con,$sql); 
    $row = mysqli_fetch_assoc($query);
    $cid= 0;
    $leave= $row["tleave"];
    $l_update=1;
    $cname= $_POST['cname'];
    $email = $_POST['cmail'];
    $cphone = $_POST['cphone'];	
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $product = $_POST["fdate"];
    $category = $_POST["category"];
    $total= $_POST["total"];
    $time=0;
    if($cphone>0)
    {
        $sql1 = "INSERT INTO `leavelist` (`e_id`, `e_name`,`leavet`, `d_to`, `details`,`d_from`, `ae_id`, `totalle`, `l_update`) VALUES ('$cname','$email','$category','$subject','$message','$product','$cid','$total','$l_update')"; 
        $leave=$leave-$total;
        $sql1= "UPDATE `supervisior` SET  `tleave`='$leave'   WHERE s_id='$id'";
        $query2 = mysqli_query($con,$sql1);
        if($query2){
             echo '<script>alert("New Leave is added ")</script>';
            echo '<script>window.location="addleaves.php"</script>';
        }
    }
    else{
        echo '<script>alert("Your Leave Balance is Empty Please Contact With Your Supervisior or Admin ")</script>';
        echo '<script>window.location="spprofile.php"</script>';
        }
    }		
?>
    </div>
</div>
    </body>
</html>