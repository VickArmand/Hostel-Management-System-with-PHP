<?php
require_once('includes/inc1.php');
require_once('includes/sidebar.php');
require_once('includes/connection.php');

if(isset ($_SESSION['admin'])){
    if(isset($_POST["updaterent"]))
    {
        if (empty($_POST['id2'])||empty($_POST['tid'])||empty($_POST['rent'])||empty($_POST['bal'])||empty($_POST['means'])||empty($_POST['status'])||empty($_POST['rno'])||empty($_POST['period'])) {
			header("location: ../admin/rentedit.php?error= Please fill in all the above fields ");
			exit();
		}
		else{
            $id2=test_input($_POST["id2"]);
            $tid2=test_input($_POST["tid"]);
            $rno2=test_input($_POST["rno"]);
			$rent=test_input($_POST["rent"]);    
			$bal=test_input($_POST["bal"]);    
			$means=test_input($_POST["means"]);    
			$status=test_input($_POST["status"]);       
			$period=test_input($_POST["period"]);    

			$date=date("Y-m-d h:i:sa");
		
			

$sql = "UPDATE rentpayments SET tenants_rooms_room_number='".$rno2."',tenants_tenant_id='".$tid2."',amount_paid='".$rent."',balance='".$bal."',payment_means='".$means."',rent_status='".$status."',period='".$period."',update_date='".$date."' WHERE transaction_id= '".$id2."'"; 
if (mysqli_query($conn, $sql)) { 
header("location: ../admin/rentedit.php?error=Record Updated Successfully");

}    
						
                        else {
							header("location: ../admin/rentedit.php?error=Something went wrong please try again");
							exit();
						}    
						
					}
					}
				}
                if(isset ($_POST['viewrentdetails'])){
                    $id=$_POST['tid'] ;
                    $ret="select transaction_id,amount_paid,balance,payment_means,rent_status,period,tenants_tenant_id,tenants_rooms_room_number from rentpayments WHERE transaction_id='".$id."'";

                    $res=mysqli_query($conn, $ret);
              if($res)
                    {
              while ($row=mysqli_fetch_array($res))
                    {
                        $tid=$row["transaction_id"]; 
                        $idno2=$row["tenants_tenant_id"]; 
                        $amt=$row["amount_paid"];
                        $bal=$row["balance"];
                        $means2=$row["payment_means"];
                        $status2=$row["rent_status"];
                        $rno=$row["tenants_rooms_room_number"];
                        $payperiod=$row["period"];
                   
                    
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
<form method="POST" action="">
<input type="hidden"value="<?php echo $id;?>" name="id2" >
Transaction ID:
<input type="text" placeholder="Enter the Transaction ID" class="form-control my-2" name="tid" value="<?php echo $tid;?>">
Tenant ID:
<input type="text" placeholder="Enter the Tenant ID" class="form-control my-2" name="idno" value="<?php echo $idno2;?>">
Tenant's Room Number
<input type="text" placeholder="Enter the Tenant's Room Number"class="form-control my-2" name="rno"value="<?php echo $rno;?>">
Amount of rent paid:
<input type="text" placeholder="Enter the amount of rent paid" class="form-control my-2" name="rent"value="<?php echo $amt;?>">
Enter the balance:
<input type="text" placeholder="Enter the balance" class="form-control my-2"name="bal" value="<?php echo $bal;?>" >
<select name="means"  class="form-control my-2" >
<option value="">Select the means of payment</option>
                        <option value="Cash" <?php if($means2 == "Cash") { echo "selected"; }?>>Cash</option>
                        <option value="Money Transfer"<?php if($means2 == "Money Transfer") { echo "selected"; }?>>Money Transfer</option>
						</select>
						Payment Status:
<input type="radio" name="status" value="Full"<?php if($status2 == "Full") { echo "checked"; }?>>Full Payment
<input type="radio" name="status" value="Partial"<?php if($status2 == "Partial") { echo "checked"; }?>>Partial Payment
<br>
Period of payment:
<input type="text" name="period" placeholder="Enter the period of payment" class="form-control my-2" onfocus="(this.type='date')" value="<?php echo $payperiod;?>">

<button class="btn btn-success" name= "updaterent">UPDATE RECORD</button>
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