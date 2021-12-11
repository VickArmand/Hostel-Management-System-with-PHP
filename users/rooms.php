<?php
require_once('includes/header.php');
require_once('includes/dblinkusers.php');
require_once('includes/sidebar.php');
error_reporting(0);
if(isset ($_SESSION['users'])){
        
   $ret="select room_number,details,rent,current_status from rooms";
   $res=mysqli_query($conn, $ret);
   $cnt=1;
   if(mysqli_num_rows($res))
   {?>
      <body>
      <div class="bodycontent">
<div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
        <input type="search" id="search" placeholder="Search" class="form-control m-2">

        <?php
				if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
			<?php
			}				
?>
      <table style="width:120%; margin-top:50px" cellborder="0" class=" cell-border table table-sm table-condensed table-striped table-bordered table-hover">
<thead>
<tr>
                                <th>Row</th>
                         <th>Room Number</th>
                         <th>Details </th>
                         <th>Rent per month</th>
                         <th>Room Status</th>
                         
                      </tr>
                   </thead>
                   <?php
       while ($row=mysqli_fetch_array($res))
       {
           $roomno=$row["room_number"];
           $details=$row["details"];
           $rent=$row["rent"];
           $status=$row["current_status"];
          
           


             ?>
          
   <tbody>
   <tr><td><?php echo $cnt;?></td>

<td><?php echo $roomno?></td>
<td><?php echo $details;?></td>
<td><?php echo $rent;?></td>
<td><?php echo $status;?></td>

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
   </body>
   <script src="includes/js/main.js"></script>
   
 <?php      
    
}
else{
   header("location: ../users/login.php");
}
?>