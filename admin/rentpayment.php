<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');

if(isset ($_SESSION['admin'])){
    if(isset($_POST["insertrent"]))
    {
        if (empty($_POST['idno'])||empty($_POST['bal'])||empty($_POST['tid'])||empty($_POST['rent'])||empty($_POST['means'])||empty($_POST['status'])||empty($_POST['rno'])||empty($_POST['period'])) {
			header("location: ../admin/rentpayment.php?error= Please fill in all the above fields ");
			exit();
		}
		else{
			
							$tid=test_input($_POST["tid"]);	 
							$idno=test_input($_POST["idno"]);	 

							$rent=test_input($_POST["rent"]);    
						   
							$means=test_input($_POST["means"]);    
							$status=test_input($_POST["status"]);    
							$bal2=test_input($_POST["bal"]); 
							$rno=test_input($_POST["rno"]);    
							$period=test_input($_POST["period"]);    
				
							$date=date("Y-m-d h:i:sa");
					
						
							$ret="select rent from rooms WHERE room_number= '".$rno."'";
							
							$res=mysqli_query($conn, $ret);
						 if($res)
							{
						 while ($row=mysqli_fetch_array($res))
							{
								
						 
							$rent2=$row["rent"];
							
						 }
						 $bal2=$rent2-$rent;
							}
							
	 
							
		
	
				
					
							$sqlsearch="SELECT transaction_id,amount_paid,balance,payment_means,rent_status,period,tenants_tenant_id,tenants_rooms_room_number FROM rentpayments WHERE transaction_id='".$idno."''";
						$result=mysqli_query($conn,$sqlsearch);
						if(mysqli_fetch_assoc($result)){
							header("location: ../admin/rentpayment.php?error=Record already exists");
							exit();
						}
						else{
						
							$sql = "INSERT INTO rentpayments (transaction_id,amount_paid,balance,payment_means,rent_status,period,insert_period,update_date,tenants_tenant_id,tenants_rooms_room_number) VALUES ('$tid', '$rent','$bal2','$means','$status','$period','$date','$date','$idno',$rno')";
							if (mysqli_query($conn, $sql)) { 
							
								header("location: ../admin/rentpayment.php?error=Record Inserted Successfully");
								exit();
								
							}
						
                        else {
							header("location: ../admin/rentpayment.php?error=Something went wrong please try again".mysqli_connect_error());
							exit();
						}    
						}
					}
					}
				}
			
	 
	
			
				
		
		
	
  
    

else{
   header("location: ../admin/login.php");
}

	
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



 error_reporting(0);
 ?>
 <body>
 <div class="bodycontent">
<div class="container">
	
    <div class="row">
        <div class="col-lg-6 m-auto">
<form method="POST" action="" name="form1">
<input type="text" placeholder="Enter the Transaction ID" class="form-control my-2" name="tid" >
<input type="text" placeholder="Enter the Tenant ID " class="form-control my-2" name="idno" >


<select name="rno"  class="form-control">
<option value="">Select A Room</option>
<?php
 $sql = "SELECT * FROM rooms "; 
 $result = mysqli_query($conn, $sql); 
 
if($result)
                    {
                        while ($row=mysqli_fetch_array($result))
                        {
                            $roomno2=$row["room_number"];
                           


echo"<option >$roomno2</option>";


                        }
                    }
?>
</select>

<input type="text" placeholder="Enter the amount of rent paid" class="form-control my-2" name="rent" >
<input type="text" placeholder="Enter the balance" class="form-control my-2" name="bal" >



<select name="means"  class="form-control my-2">
<option value="">Select the means of payment</option>
                        <option value="Cash">Cash</option>
                        <option value="Money Transfer">Money Transfer</option>
						</select>
						Payment Status:
<input type="radio" name="status" value="Full">Full Payment
<input type="radio" name="status" value="Partial">Partial Payment

<input type="text" name="period" placeholder="Enter the period of payment" class="form-control my-2" onfocus="(this.type='date')">

<button class="btn btn-success" name= "insertrent">INSERT RECORD</button>
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