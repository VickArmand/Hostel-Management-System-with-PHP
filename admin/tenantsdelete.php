<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');
if(isset ($_SESSION['admin'])){
     if(isset($_POST["tenantdelete"]))   
     {
   $id=$_POST["tenantid"];
   $check= mysqli_query($conn,"select* from tenants where tenant_id=".$id."") or die("Connection failed: " .mysqli_connect_error()); 
   if(mysqli_num_rows($check)){
 
$sql = "SELECT rooms_room_number FROM tenants WHERE tenant_id='.$tenantid1.' "; 
    $result = mysqli_query($conn, $sql); 
    
    if($result)
        {
            while ($row=mysqli_fetch_array($result))
            {
                $rno2=$row["rooms_room_number"];
            }
          }  
    $sql = "UPDATE rooms SET current_status='VACANT' WHERE room_number= '".$rno2."'"; 
                                          if (mysqli_query($conn, $sql)) { 
                                              header("location: ../admin/tenantsignup.php?error=Record Updated Successfully");
                          
                                          }    
                          
                                            else {
                                            header("location: ../admin/tenantsignup.php?error=Something went wrong please try again");
                                            exit();
                                          }    
 $sql = "DELETE FROM tenants WHERE tenant_id= ".$id."";  
if (mysqli_query($conn, $sql)) { 

 
    
    header("location: ../admin/tenants.php?error=Record Deleted Successfully");
    
 
   exit();
}


else{
?>
<script>alert("Something went wrong please try again later");</script>

<?php
   header("location: ../admin/tenants.php?error=Something went wrong please try again later");    
 
    exit();
}
}  
else{
  ?>
<script>alert("Record not available");</script> 

<?php
header("location: ../admin/tenants.php?error=Record not available");
    
 
exit();
}
   } 

}  

else{
   header("location: ..admin/login.php");
}
error_reporting(0);
?>