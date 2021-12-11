<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
    if (isset($_POST['createroom'])) {
		if (empty($_POST['roomno'])||empty($_POST['roomdetails'])||empty($_POST['fees'])) {
			header("location: ../admin/roomadd.php?error= Please fill in all the above fields ");
			exit();
		}
		else{
			
			$rno=test_input($_POST["roomno"]);	
			$rdetails=test_input($_POST["roomdetails"]);
			$fees=test_input($_POST["fees"]);    
			$date=date("Y-m-d h:i:sa");
		
			
		if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
		  header("location: ../admin/adminadd.php?error=Only letters and white space allowed");
		exit();
		}
		else if (!preg_match("/^[a-zA-Z]*$/",$sname)) {
			header("location: ../admin/adminadd.php?error=Only letters and white space allowed");
		  exit();
		  }		
		  else if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
			header("location: ../admin/adminadd.php?error=Only letters and white space allowed");
		  exit();
		  }		  
		  
		
	
		
						else{
						
						$sqlsearch="SELECT * FROM rooms WHERE room_number='".$rno."'";
						$result=mysqli_query($conn,$sqlsearch);
						if(mysqli_fetch_assoc($result)){
							header("location: ../admin/adminadd.php?error=The room number already exists");
							exit();
						}
						
						else{
							
							$sql = "INSERT INTO rooms (room_number,details,rent,posting_date,current_status) VALUES ('$rno','$rdetails','$fees','$date','VACANT')";
							if (mysqli_query($conn, $sql)) { 
								header("location: ../admin/roomadd.php?error=Room Created Successfully");
								exit();
								}
							
						else {
							header("location: ../admin/roomadd.php?error=Something went wrong please try again".mysqli_error($conn));
							exit();
						}    
						}
					}
				}
			}
	 }	
	
else{
   header("location: ../admin/admin.php");
}

	
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<div class="bodycontent">
<div class="container">
	
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card bg-light mt-3">
                <div class="card-title bg-primary text-white mt-3">
                    <h3 class="text-center py-2">Create Room Form</h3>
                </div>
                
                <div class="card-body">
                    <form action="" method="POST">
                    <input type="name" name="roomno" placeholder="Enter the Room Number you wish to create" class="form-control my-2">
                    <textarea name="roomdetails" placeholder="Enter the Room Details" class="form-control my-2" rows="5" cols="40"></textarea>
                    <input type="name" name="fees" placeholder="Enter the rent amount" class="form-control my-2">
                   
                    <button class="btn btn-success" name="createroom">ADD ROOM</button>
                    <?php
                    
                    if(isset($_GET['error'])){
                    ?>
                <div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
                <?php
                }				
    ?>