<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');
if(isset ($_SESSION['admin'])){
  
  $ret="select tenant_id,id_number,first_name,second_name,last_name,username,gender,email,contact,rooms_room_number,reg_date from tenants";
  $res=mysqli_query($conn, $ret);
  $cnt=1;
  if(mysqli_num_rows($res))
  {
    ?>
    <body>
    <div class="bodycontent">
    <div class="container">
    <div class="row">
  
<div class="col-lg-8 m-auto">
<input type="search" id="search" placeholder="Search" class="form-control m-2">

    <table style="width:120%; margin-top:50px" class="table table-sm table-condensed table-striped table-bordered table-hover">  <thead>
    <?php
if(isset($_GET['error'])){
               ?>
               
           <div class="alert alert-danger"><?php echo $_GET['error']  ?></div>
           <?php
            }
            ?>
<tr>
                        <th>Tenant ID</th>
                        <th>ID Number</th>
                       <th>Name</th>
                       <th>Username </th>
                       <th>Room Number</th>
                       <th>Email Address </th>
                       <th>Gender </th>
                       <th>Contact </th>      
                      <th>Registration Date</th>
                      <th colspan="2">Action</th>
                    </tr>
                 </thead>
                 <?php
      while ($row=mysqli_fetch_array($res))
      {
        $tenantid=$row["tenant_id"]; 
          $idno=$row["id_number"]; 
          $fname=$row["first_name"];
          $sname=$row["second_name"];
          $lname=$row["last_name"];
          $uname=$row["username"];
          $email=$row["email"];
          $gender=$row["gender"];
          $roomno=$row["rooms_room_number"];
          $pno=$row["contact"];
          $reg=$row["reg_date"];
          ?>
  <tbody>
  <tr>
  <td><?php echo $tenantid;?></td>
  <td><?php echo $idno;?></td>
<td><?php echo $fname;?><?php echo $sname;?><?php echo $lname;?></td>
<td><?php echo $uname?></td>
<td><?php echo $roomno;?></td>
<td><?php echo $email;?></td>
<td><?php echo $gender;?></td>
<td><?php echo $pno;?></td>
<td><?php echo $reg;?></td>


<form action="tenantsedit.php" method="POST">
<input type="hidden" name="tenantid" value=<?php echo $row['tenant_id'];?>>

<td ><input type="submit" class="btn btn-info" name="viewtenant" value="VIEW DETAILS" ></td>
</form>
<form action="tenantsdelete.php" method="POST">
<input type="hidden" name="tenantid" value=<?php echo $row['tenant_id'];?> >

<td><input type="submit" class="btn btn-danger" name="tenantdelete" value="DELETE" ></td>
</form> </tr>

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
  </body>
  <script src="includes/js/main.js"></script>
       
</html>      
<?php 
   } 
   

   else{
    header("location: ../admin/login.php");
 }
 
error_reporting(0);
?>


