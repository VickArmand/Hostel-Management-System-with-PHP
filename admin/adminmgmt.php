
<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
    if(isset($_POST['deleteadmin'])){
        $id=$_POST['adminid'] ;
        $check= mysqli_query($conn,"select admin_id,email,first_name,second_name,last_name,username,gender,contact,ID_number from admin where admin_id=".$id."") or die("Connection failed: " .mysqli_connect_error()); 
        if(mysqli_num_rows($check)){
     $sql = "DELETE FROM admin WHERE admin_id= ".$id.""; 
     if (mysqli_query($conn, $sql)) { 
        
        header("location: ../admin/adminmgmt.php?error=Record Deleted Successfully");
    
 
        exit();
     }
  
  
  else{
     ?>
     <script>alert("Something went wrong please try again later");</script>

     
     <?php

  }
    }  else{
       ?>

<script>alert("Record not available");</script>
     <?php

     exit();
     }
        } 
  
  
 
        $ret="select admin_id,email,first_name,second_name,last_name,username,gender,contact,ID_number from admin";
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
                                        <th>Admin ID</th>
                                      <th>Name</th>
                                      <th>Username </th>
                                      <th>Email Address </th>
                                      <th>Gender </th>
                                      <th>Contact </th>
                                      <th>ID Number</th>
                                      
                                      <th colspan="2">Action</th>
                                      
                                      
</tr>
</thead>
   <?php           
        while ($row=mysqli_fetch_array($res))
        {
            $id=$row["admin_id"];
            $fname=$row["first_name"];
            $sname=$row["second_name"];
            $lname=$row["last_name"];
            $uname=$row["username"];
            $email=$row["email"];
            $gender=$row["gender"];
            $pno=$row["contact"];
            $idno=$row["ID_number"];
           
              ?>
             				
   <tbody>
    <tr>
    
    <td><?php echo $id?></td>   
<td><?php echo $fname;?> <?php echo $sname;?> <?php echo $lname;?></td>
<td><?php echo $uname?></td>
<td><?php echo $email;?></td>
<td><?php echo $gender;?></td>
<td><?php echo $pno;?></td>
<td><?php echo $idno;?></td>
<form action="adminedit.php" method="POST">
<input type="hidden" name="adminid" value=<?php echo $row['admin_id'];?> >
<td><input type="submit" class="btn btn-info" name="editadmin" value="VIEW DETAILS" ></td>
</form>
<form action="" method="POST">
<input type="hidden" name="adminid" value=<?php echo $row['admin_id'];?> >

<td><input type="submit" name="deleteadmin" value="DELETE" class="btn btn-danger"></td>
        </form>
   </tr>   
    <?php
    $cnt=$cnt+1;
}
    } else{
      ?>
      <script>
      alert("No records available");
      </script>
      <?php
   }?>
    </tbody>
    </table>
    <script src="includes/js/main.js"></script>
 
    </body>   
  <?php  
}
else{
   header("location: ../admin/login.php");
}
error_reporting(0);
?>


									
</html>