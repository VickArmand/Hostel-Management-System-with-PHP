<?php
require_once("includes/dblinkadmin.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$activeuser=$_SESSION['admin'];
$adminid1=$_SESSION['adminid'];
$sql = "SELECT ID_number,username,email,contact,first_name,second_name,last_name,gender FROM admin WHERE admin_id= '".$adminid1."'"; 
$result = mysqli_query($conn, $sql); 
if($result)
{
    while ($row=mysqli_fetch_array($result))
    {
       
      $email=$row["email"];          
      $fname=$row["first_name"]; 
      $sname=$row["second_name"]; 
      $lname=$row["last_name"]; 
      $gender=$row["gender"]; 
       $uname=$row["username"];
       $idno=$row["ID_number"]; 
      
       $pno=$row["contact"];
    }
}
?>
 <div class="bodycontent">
  <div class="container">
    <div class="row">

<div class="col-lg-8 m-auto">

    <table style="width:120%; margin-top:50px" class="table table-sm table-condensed table-striped table-bordered table-hover">  <thead>
                    <tr> 
                    <th colspan='2' style="text-align:center;"><h>PERSONAL INFORMATION</h></th>

                    </tr>
                   
                    <tbody>
                    <tr>
                    <th>Admin ID</th>
                    <th><?php echo $adminid1?></th>
        </tr>

        <tr>
        <th>ID Number</th>
        <th><?php echo $idno?></th>

        </tr>

        <tr>
        <th>Name</th>
        <th><?php echo $fname." ". $sname." ". $lname?></th>
        </tr>

        <tr>
        <th>Username </th>
        <th><?php echo $uname?></th>

        </tr>

        <tr>
        <th>Email Address </th>
        <th><?php echo $email?></th>

        </tr>

        <tr>
        <th>Contact </th>   
        <th><?php echo $pno?></th>

        </tr>

        <tr>
        <th>Gender </th>   
        <th><?php echo $gender?></th>

        </tr>
        
</tbody>           
</table>
  <a class="btn btn-primary btn-lg" href="../admin/myprofile.php" role="button">Update Basic Information</a>
</div>
</div>                       
                    