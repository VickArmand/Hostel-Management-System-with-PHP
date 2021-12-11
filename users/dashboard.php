<?php
require_once("includes/dblinkusers.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
$activeuser=$_SESSION['users'];
$tenantid1=$_SESSION['tenantid'];
$sql = "SELECT id_number,first_name,second_name,last_name,username,email,contact,rooms_room_number,county,subcounty,address,gender FROM tenants WHERE tenant_id= '".$tenantid1."'"; 
 $result = mysqli_query($conn, $sql); 
 if($result)
 {
     while ($row=mysqli_fetch_array($result))
     {
        
       $email=$row["email"];          
        $fname=$row["first_name"];
        $sname=$row["second_name"];
        $lname=$row["last_name"];
        $uname=$row["username"];
        $idno=$row["id_number"]; 
        $county=$row["county"];
        $scounty=$row["subcounty"];
        $address=$row["address"];
        $rno=$row["rooms_room_number"];
        $pno=$row["contact"];
        $gender=$row["gender"];
     }
    }

?>
 <div class="bodycontent">
<div class="col-lg-6 m-auto">
  <div class="container">
    <div class="row">

<div class="col-lg-8 m-auto">


    <table style="width:120%; margin-top:50px" class="table table-sm table-condensed table-striped table-bordered table-hover">  <thead>
   <thead>
                    <tr> 
                        <th colspan='2' style="text-align:center;"><h>PERSONAL INFORMATION</h></th>

                    </tr>
</thead>
                    <tbody>
                    <tr>
                    <th>Tenant ID</th>
                    <th><?php echo $tenantid1?></th>
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

        <tr>
        <th>Room Number</th>        
        <th><?php echo $rno?></th>

        </tr>

        <tr>
        <th>County</th>        
        <th><?php echo $county?></th>

        </tr>

        <tr>
        <th>SubCounty</th>        
        <th><?php echo $scounty?></th>

        </tr>

        <tr>
        <th>Address</th>        
        <th><?php echo $address?></th>

        </tr>
        
</tbody>           
</table>
  <a class="btn btn-primary btn-lg" href="../users/myprofile.php" role="button">Update Basic Information</a>
</div> 
  </div>
  </div>