<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
  if(isset($_POST["updaterooms"])){

    $id2=$_POST['id'] ;  
    if (empty($_POST['rdetails'])||empty($_POST['id'])||empty($_POST['status'])||empty($_POST['rent'])) {
      header("location: ../admin/roomdetails.php?error= Please fill in all the above fields ");
      exit();
   }  
   else{ 
    
   $check2= mysqli_query($conn,"select details,room_number,current_status,rent from rooms where room_number=".$id2."") or die("Connection failed: " .mysqli_connect_error()); 
  if(mysqli_num_rows($check2)){
      
    

  $rno=test_input($_POST["id"]);	
$details=test_input($_POST["rdetails"]);
$status=test_input($_POST["status"]);
$rent=test_input($_POST["rent"]);    
 $date=date("Y-m-d h:i:sa");
                   $sql = "UPDATE rooms SET details='".$details."',current_status='".$status."',rent='".$rent."',update_date='".$date."' WHERE room_number= '".$id2."'"; 
                   if (mysqli_query($conn, $sql)) { 
                      
                      header("location: ../admin/roommgmt.php?error=Record Updated Successfully");

                      
                   
                      exit();
                   }
                   
                   
                   else{
                  
                   header("location: ../admin/roommgmt.php?error=Something went wrong please try again later".mysqli_connect_error());
                    exit();         
                      }
                   
                    }
                
                  
                
                else{
              
                  header("location: ../admin/roommgmt.php?error=Record not available");
                  exit();
                }
              
             
              }
}       
            
                  
            
    if(isset ($_POST['editroom'])){
            $id=$_POST['roomno'] ;
            $ret="select  room_number,details,rent,current_status from rooms WHERE room_number= '".$id."'";

            $res=mysqli_query($conn, $ret);
      if($res)
            {
      while ($row=mysqli_fetch_array($res))
            {
             
              $id=$row["room_number"];
            $details=$row["details"];
            $status=$row["current_status"];
            $rent=$row["rent"];
          }
      }
  }

}   
else{
  header("location: ../adminlogin.php");
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
<form method="POST" action="">
<input type="hidden" value="<?php echo $id;?>" name="id">
Room Details:<?php
echo "<td><textarea rows=\"5\" cols=\"15\"class=\"form-control my-2\" name=\"rdetails\"placeholder=\"Enter the Room Details\">" .$details. "</textarea></td>";
?>
Rent:<input type="text" value="<?php echo $rent;?>"placeholder="Enter the Rent Per Month" class="form-control my-2" name="rent">
Room Status: <input type="radio"  <?php if($status == "OCCUPIED") { echo "checked"; }?> name="status" value="OCCUPIED"> OCCUPIED
<input type="radio" <?php if($status == "VACANT") { echo "checked"; }?> name="status" value="VACANT"> VACANT
<button class="btn btn-success" name= "updaterooms">UPDATE PROFILE</button>
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
</body>
