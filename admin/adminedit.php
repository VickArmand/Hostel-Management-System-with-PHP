<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
   if(isset ($_POST['updateadmin'])){
    if (empty($_POST['uname'])||empty($_POST['id'])||empty($_POST['pno'])||empty($_POST['email'])||empty($_POST['idno'])) {
        header("location: ../admin/roomdetails.php?error= Please fill in all the above fields ");
        exit();
     }  
     else{
      $id=$_POST['id'] ;
      $sql = "SELECT admin_id,email,username,contact,ID_number FROM admin WHERE admin_id= '".$id."'"; 
      $result = mysqli_query($conn, $sql); 
  
    if(mysqli_num_rows($result)){
      
    

        $id2=test_input($_POST["id"]);
        $idno2=test_input($_POST["idno"]);	
	$email2=test_input($_POST["email"]);
  $uname2=test_input($_POST["uname"]);
      $contact2= test_input($_POST["pno"]);
       $date=date("Y-m-d h:i:sa");
                         $sql = "UPDATE admin SET username='".$uname2."',email='".$email2."',contact='".$contact2."',ID_number='".$idno2."',update_date='".$date."' WHERE admin_id= '".$id2."'"; 
                         if (mysqli_query($conn, $sql)) { 
                            
                            header("location: ../admin/adminmgmt.php?error=Record Updated Successfully");
      
                            
                         
                            exit();
                         }
                         
                         
                         else{
                        
                         header("location: ../admin/adminedit.php?error=Something went wrong please try again later".mysqli_connect_error());
                          exit();         
                            }
                         
                          }
                      
                        
                      
                      else{
                    
                        header("location: ../admin/adminmgmt.php?error=Record not available");
                        exit();
                      }  
   }
}
   if(isset ($_POST["editadmin"])){
          $id=$_POST['adminid'] ;
          $sql = "SELECT admin_id,email,first_name,second_name,last_name,username,contact,ID_number FROM admin WHERE admin_id= '".$id."'"; 
          $result = mysqli_query($conn, $sql); 
    if($result)
          {
    while ($row=mysqli_fetch_array($result))
          {
           
              $id=$row["admin_id"];
              $fname=$row["first_name"];
              $sname=$row["second_name"];
              $lname=$row["last_name"];
              $uname=$row["username"];
              $email=$row["email"];
              $pno=$row["contact"];
              $idno=$row["ID_number"];
          }
      }
      }
    
    
   }
   else{
   header("location: ../admin/login.php");
   }
   error_reporting(0);
   function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
     ?>
   
<body>
<div class="bodycontent">
<div class="container">
	
    <div class="row">
        <div class="col-lg-6 m-auto">
<form method="POST" action="adminedit.php">
<input type="hidden" name="id"value="<?php echo $id;?>" >
ID Number:<input type="text" value="<?php echo $idno;?>"placeholder="Enter the ID Number" class="form-control my-2" name="idno">
First Name:<input type="text" value="<?php echo $fname;?>"placeholder="Enter the First Name" class="form-control my-2" name="fname" disabled>
Middle Name:<input type="text" value="<?php echo $sname;?>"placeholder="Enter the Middle Name" class="form-control my-2"name="sname" disabled>
Surname:<input type="text" value="<?php echo $lname;?>"placeholder="Enter the Surname" class="form-control my-2" name="lname" disabled>
Username:<input type="text" value="<?php echo $uname;?>"placeholder="Enter the Username" class="form-control my-2" name="uname">
Email:<input type="text" value="<?php echo $email;?>"placeholder="Enter the Email Address" class="form-control my-2"name="email">
Phone Number: <input type="text" value="<?php echo $pno;?>"placeholder="Enter the Phone Number" class="form-control my-2"name="pno">

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

