<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');

error_reporting(0);
if(isset ($_SESSION['admin'])){
        
   $ret="select transaction_id,amount_paid,balance,payment_means,rent_status,period,tenants_tenant_id,tenants_rooms_room_number from rentpayments";
   $res=mysqli_query($conn, $ret);
   $cnt=1;
   if(mysqli_num_rows($res))
   {
      ?>
      <body>
      <div class="bodycontent">
      <div class="row">
        <div class="col-lg-6 m-auto">
        <input type="search" id="search" placeholder="Search" class="form-control m-2">

        <table style="width:120%; margin-top:50px" class="table table-sm table-condensed table-striped table-bordered table-hover">
        <?php
				if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
			<?php
			}				
?>
<thead>
<tr>
                     <th>Row</th>
                     <th>Transaction ID</th>
                     <th>Tenant ID</th>   
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Means Of Payment</th>
                    <th>Level of Payment</th>
                    <th>Room Number</th>
                    <th>Date of Payment</th>
                    <th colspan="2">Action</th>
                  </tr>
               </thead>
               <?php
       while ($row=mysqli_fetch_array($res))
       {
         $tid=$row["transaction_id"]; 
         $idno=$row["tenants_tenant_id"]; 
         $amt=$row["amount_paid"];
         $bal=$row["balance"];
         $means=$row["payment_means"];
         $status=$row["rent_status"];
         $roomno=$row["tenants_rooms_room_number"];
         $period=$row["period"];

            ?>
<tbody>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $tid;?></td>
<td><?php echo $idno;?></td>
<td><?php echo $amt?></td>
<td><?php echo $bal;?></td>
<td><?php echo $means;?></td>
<td><?php echo $status;?></td>
<td><?php echo $roomno;?></td>
<td><?php echo $period;?></td>
<form action="rentedit.php" method="POST">
<input type="hidden" name="keytodelete" value=<?php echo $row['id'];?>>

<td ><input type="submit" class="btn btn-info" name="viewrentdetails" value="VIEW DETAILS" ></td>
</form>
<form action="printreceipt.php" method="POST">
<input type="hidden" name="keytodelete" value=<?php echo $row['id'];?> >

<td><input type="submit" class="btn btn-success" name="printreceipt" value="PRINT RECEIPT" ></td>
</form>

</tr>

   
   
   <?php
   $cnt=$cnt+1;
}
   } 
   else{
      ?>
      <script>
      alert("No records available");
      </script>
      <?php
   }?>
   </tbody>
   </table> 
   </div>
   </div>
</div>
   <script src="includes/js/main.js"></script>

   </body>       
   <?php  
   
}
else{
   header("location: ../admin/login.php");
}
?>