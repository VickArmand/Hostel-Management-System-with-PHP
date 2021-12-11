<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
  if(isset($_POST["updateadmin"])){
    
      $adminid1=$_SESSION['adminid'];
    if (empty($_POST['pno'])||empty($_POST["idno"])||empty($_POST['uname'])||empty($_POST['email'])) {
      header("location: ../admin/myprofile.php?error= Please fill in all the above fields ");
      exit();
   }  
   else{ 
    
    $check2= mysqli_query($conn,"select ID_number,username,email,contact from admin where admin_id=".$adminid1.""); 
   if(mysqli_num_rows($check2)){

                   
                  $idno=test_input($_POST["idno"]);	    
                $username= test_input($_POST["uname"]);
                $email= test_input($_POST["email"]);
                $contact=test_input($_POST["pno"]);
                
                  $adminid3=$_POST['adminid'];  
                  $date=date("Y-m-d h:i:sa");
                 
              
                
                
                   $sql = "UPDATE admin SET ID_number='".$idno."',username='".$username."',email='".$email."',contact='".$contact."',update_date='".$date."' WHERE admin_id= '".$adminid3."'"; 
                   if (mysqli_query($conn, $sql)) { 
                                           
                      header("location: ../admin/myprofile.php?error=Profile Updated Successfully");
                      exit();
                      
                   
                      exit();
                   }
                   
                   
                   else{
                  
                   header("location: ../admin/myprofile.php?error=Something went wrong please try again later".mysqli_connect_error());
exit();
                                 
                                    }
                              }
                                
            
                        
            else{

          header("location: ../admin/myprofile.php?error=Record not available");
          exit();

                }  
                
                 
                   
            
            }
          }                                


     $activeuser=$_SESSION['admin'];
      $sql = "SELECT admin_id,ID_number,username,email,contact FROM admin WHERE username= '".$activeuser."'"; 
      $result = mysqli_query($conn, $sql); 
      if($result)
      {
          while ($row=mysqli_fetch_array($result))
          {
            $adminid=$row["admin_id"];  
            $email=$row["email"];          
             
             $uname=$row["username"];
             $idno=$row["ID_number"]; 
            
             $pno=$row["contact"];

            
  ?>     

<body>
<div class="bodycontent">
<div class="container">
<div class="row">
        <div class="col-lg-6 m-auto">
<form method="POST" action="">
<input type="hidden" value="<?php echo $tenantid;?>" name="adminid">
Email Address :
<input type="text" value="<?php echo $email;?>"placeholder="Enter the Email Address" class="form-control my-2"name="email">
ID Number :
<input type="text" value="<?php echo $idno;?>"placeholder="Enter the ID Number" class="form-control my-2" name="idno">

Username :
<input type="text" value="<?php echo $uname;?>"placeholder="Enter the Username" class="form-control my-2" name="uname">
Phone Number :
<input type="text" value="<?php echo $pno;?>"placeholder="Enter the Phone Number" class="form-control my-2"name="pno">

<?php
}
}
?>
<button class="btn btn-success" name="updateadmin">UPDATE PROFILE</button>
<?php
if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
<?php
}
?>
</form>

</div>
</div>
</div>
</div>
</body>
<?php
   
 
}
else{
    header("location: ../users/login.php");
 }
error_reporting(0);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>