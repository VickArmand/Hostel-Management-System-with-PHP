<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
error_reporting(0);
if(isset ($_SESSION['admin'])){
    if(isset($_POST["deleteroom"]))
    {
      $id=$_POST["roomno"] ;
 $check= mysqli_query($conn,"select room_number,details,rent,current_status from rooms where room_number=".$id.""); 
 if(mysqli_num_rows($check)){
   
                   // $sql = "DELETE  FROM rooms WHERE room_number= '.$id.'";  
                   $sql = "DELETE  FROM rooms WHERE room_number=".$id."";  

                    if (mysqli_query($conn, $sql)) { 
                    
                    
                    header("location: ../admin/roommgmt.php?error=Record Deleted Successfully");

                    exit();
                    }


                    else{
                    header("location: ../admin/roommgmt.php?error=Something went wrong please try again later".mysqli_connect_error($conn));
                    

                    exit();
                    }
}  else{

header("location: ../admin/roommgmt.php?error=Record not available");
exit();
}

 }    
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

      <table style="width:120%; margin-top:20px" class="table table-sm table-condensed table-striped table-bordered table-hover">
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
                         <th>Room Number</th>
                         <th>Details </th>
                         <th>Rent per month</th>
                         <th>Room Status</th>
                         <th colspan="2">Action</th>
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
<form action="roomedit.php" method="POST">
<input type="hidden" name="roomno" value=<?php echo $roomno;?> >
<td><input type="submit" class="btn btn-info" name="editroom" value="VIEW DETAILS" ></td>
</form>
<form action="" method="POST">
<input type="hidden" name="roomno" value=<?php echo $roomno;?> >

<td><input type="submit" name="deleteroom" value="DELETE" class="btn btn-danger"></td>
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
   </body>
 
   <script src="includes/js/main.js"></script>
 
 <?php      
    
}
else{
   header("location: ../admin/login.php");
}
?>