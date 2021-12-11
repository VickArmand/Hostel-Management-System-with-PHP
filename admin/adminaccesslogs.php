
<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
      
        $ret="select log_id,ip,login_time,admin_admin_id from adminlog";
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

        <table style="width:120%; margin-top:50px" class="display table table-striped table-bordered table-hover">
<thead>
<tr>
                              
                                  
                                      <th>Log ID</th>
                                      <th>Admin ID</th>
                                      <th>IP Address</th>
                                      <th>Login Time </th>
                                      
                                  </tr>
                              </thead>
                              <?php
        while ($row=mysqli_fetch_array($res))
        {
            $userid=$row["admin_admin_id"];
            $logid=$row["log_id"];
            $ip=$row["ip"];
            $login=$row["login_time"];
            


              ?>
            
    <tbody>
    

<td><?php echo $logid?></td>
<td><?php echo $userid;?></td>
<td><?php echo $ip;?></td>
<td><?php echo $login;?></td>
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
