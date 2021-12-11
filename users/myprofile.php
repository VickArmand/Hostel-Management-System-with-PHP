<?php

require_once('includes/header.php');
require_once('includes/dblinkusers.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['users'])){

  $tenantid1=$_SESSION['tenantid'];
 
  if(isset($_POST["updatetenants"])){
    

    $tenantid1=$_SESSION['tenantid'];
    if (empty($_POST['roomno'])||empty($_POST['pno'])||empty($_POST["idno"])||empty($_POST['uname'])||empty($_POST['email'])||empty($_POST['address'])||empty($_POST['county'])||empty($_POST['subcounty'])) {
      header("location: ../users/myprofile.php?error= Please fill in all the above fields ");
      exit();
   }  
  
   
 
   else{      
                $check2= mysqli_query($conn,"select id_number,username,email,contact,rooms_room_number from tenants where tenant_id=".$tenantid1.""); 
                if(mysqli_num_rows($check2)){
                                $sqlsearch="SELECT id_number,username,email,contact,rooms_room_number FROM tenants WHERE username='".$_POST["uname"]."'";
                                        $result=mysqli_query($conn,$sqlsearch);
                                      if(mysqli_num_rows($result)){
                                          header("location: ../users/myprofile.php?error=The Username is already taken");
                                          exit();
                                        }
                                        
                                        $sqlsearch2="SELECT id_number,username,email,contact,rooms_room_number FROM tenants WHERE email='".$_POST["email"]."'";
                                        $result2=mysqli_query($conn,$sqlsearch2);
                                        if(mysqli_num_rows($result2)){
                                          header("location: ../users/myprofile.php?error=The Email is already taken");
                                          exit();
                                        }
                                            
                                                      $sqlsearch3="SELECT id_number,username,email,contact,rooms_room_number FROM tenants WHERE id_number='".$_POST["idno"]."'";
                                                  $result2=mysqli_query($conn,$sqlsearch3);
                                                  if(mysqli_num_rows($result2)){
                                                      header("location: ../users/myprofile.php?error=The Identification Number is already taken");
                                                      exit();
                                                  }
                                              $sqlsearch3="SELECT id_number,username,email,contact,rooms_room_number FROM tenants WHERE rooms_room_number='".$_POST["roomno"]."'";
                                                      $result2=mysqli_query($conn,$sqlsearch3);
                                                      if(mysqli_num_rows($result2)){
                                                        header("location: ../users/myprofile.php?error=The Room is already occupied");
                                                        exit();
                                                      }
            else{
                                            $idno=test_input($_POST["idno"]);	    
                                          $username= test_input($_POST["uname"]);
                                          $email= test_input($_POST["email"]);
                                          $contact=test_input($_POST["pno"]);
                                          $roomno=test_input($_POST["roomno"]);
                                          $county=test_input($_POST["county"]);
                                            $scounty=test_input($_POST["subcounty"]);
                                            $address=test_input($_POST["address"]);
                                            $tenantid3=$_POST['tenantid'];  

                                          $date=date("Y-m-d h:i:sa");
                                        
                                
                                          $sql = "SELECT rooms_room_number FROM tenants WHERE tenant_id='.$tenantid1.' "; 
                                          $result = mysqli_query($conn, $sql); 
                                          
                                          if($result)
                                              {
                                                  while ($row=mysqli_fetch_array($result))
                                                  {
                                                      $rno2=$row["rooms_room_number"];
                                                  }
                                                }  
                                          $sql = "UPDATE rooms SET current_status='VACANT' WHERE room_number= '".$rno2."'"; 
                                          if (mysqli_query($conn, $sql)) { 
                          header("location: ../users/myprofile.php?error=Record Updated Successfully");

                          }    

                          else {
                          header("location: ../users/myprofile.php?error=Something went wrong please try again");
                          exit();
                          }   
                          $sql = "UPDATE rooms SET current_status='OCCUPIED' WHERE room_number= '".$roomno."'"; 
                          if (mysqli_query($conn, $sql)) { 
                          header("location: ../users/myprofile.php?error=Record Updated Successfully");

                          }    

                          else {
                          header("location: ../users/myprofile.php?error=Something went wrong please try again");
                          exit();
                          }    
                                            $sql = "UPDATE tenants SET id_number='".$idno."',username='".$username."',email='".$email."',contact='".$contact."',update_date='".$date."',rooms_room_number='".$roomno."',county='".$county."',subcounty='".$scounty."',address='".$address."' WHERE tenant_id= '".$tenantid3."'"; 
                                            if (mysqli_query($conn, $sql)) { 
                                                                      
                                                header("location: ../users/myprofile.php?error=Profile Updated Successfully");
                                                exit();
                                                
                                            
                                                exit();
                                            }
                                            
                                            
                                            else{
                                            
                                            header("location: ../users/myprofile.php?error=Something went wrong please try again later".mysqli_connect_error());
                                              exit();
                                                  }


                  }

           }
           else{

            header("location: ../users/myprofile.php?error=Record not available");
            exit();
    
              }


        }//close first else

  }//endif post updatetenants
  
 

 $sql = "SELECT tenant_id,id_number,first_name,second_name,last_name,username,email,contact,rooms_room_number,county,subcounty,address FROM tenants WHERE tenant_id= '".$tenantid1."'"; 
 $result = mysqli_query($conn, $sql); 
 if($result)
 {
     while ($row=mysqli_fetch_array($result))
     {
       $tenantid=$row["tenant_id"];  
       $email=$row["email"];          
        $fname=$row["first_name"];
        $sname=$row["second_name"];
        $lname=$row["last_name"];
        $uname=$row["username"];
        $idno=$row["id_number"]; 
        $county=$row["county"];
        $scounty=$row["subcounty"];
        $address=$row["address"];
        $rno=$row["rooms_room_number"];
        $pno=$row["contact"];

       
?>     

<body>
<div class="bodycontent">
<div class="container">
<div class="row">
   <div class="col-lg-6 m-auto">
<form method="POST" action="">
<input type="hidden" value="<?php echo $tenantid;?>" name="tenantid">
Email Address:
<input type="text" value="<?php echo $email;?>"placeholder="Enter the Email Address" class="form-control my-2"name="email">
ID Number:
<input type="text" value="<?php echo $idno;?>"placeholder="Enter the ID Number" class="form-control my-2" name="idno">
Username:
<input type="text" value="<?php echo $uname;?>"placeholder="Enter the Username" class="form-control my-2" name="uname">
Phone Number:
<input type="text" value="<?php echo $pno;?>"placeholder="Enter the Phone Number" class="form-control my-2"name="pno">
Select A Room:
<select name="roomno"  class="form-control" value="">
<option value="<?php echo $rno;?>" placeholder="Select a room"><?php echo $rno;?></option>
<?php
$sql = "SELECT room_number FROM rooms "; 
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
Select A County:
           <select name="county"  class="form-control"  >
                   <option value="<?php echo $county;?>"><?php echo $county;?></option>
                   <option value="Mombasa">Mombasa</option>
                   <option value="Kwale">Kwale</option>
                   <option value="Kilifi">Kilifi</option>
                   <option value="Tana River">Tana River</option>
                   <option value="Lamu">Lamu</option>
                   <option value="Taita–Taveta">Taita–Taveta</option>
                   <option value="Garissa">Garissa</option>
                   <option value="Wajir">Wajir</option>
                   <option value="Mandera">Mandera</option>
                   <option value="Marsabit">Marsabit</option>
                   <option value="Isiolo">Isiolo</option>
                   <option value="Meru">Meru</option>
                   <option value="Tharaka-Nithi">Tharaka-Nithi</option>
                   <option value="Embu">Embu</option>
                   <option value="Kitui">Kitui</option>
                   <option value="Machakos">Machakos</option>
                   <option value="Makueni">Makueni</option>
                   <option value="Nyandarua">Nyandarua</option>
                   <option value="Nyeri">Nyeri</option>
                   <option value="Kirinyaga">Kirinyaga</option>
                   <option value="Murang'a">Murang'a</option>
                   <option value="Kiambu">Kiambu</option>
                   <option value="Turkana">Turkana</option>
                   <option value="West Pokot">West Pokot</option>
                   <option value="Samburu">Samburu</option>
                   <option value="Trans-Nzoia">Trans-Nzoia</option>
                   <option value="Uasin Gishu">Uasin Gishu</option>
                   <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
                   <option value="Nandi">Nandi</option>
                   <option value="Baringo">Baringo</option>
                   <option value="Laikipia">Laikipia</option>
                   <option value="Nakuru">Nakuru</option>
                   <option value="Narok">Narok</option>
                   <option value="Kajiado">Kajiado</option>
                   <option value="Kericho">Kericho</option>
                   <option value="Bomet">Bomet</option>
                   <option value="Kakamega">Kakamega</option>
                   <option value="Vihiga">Vihiga</option>
                   <option value="Bungoma">Bungoma</option>
                   <option value="Busia">Busia</option>
                   <option value="Siaya">Siaya</option>
                   <option value="Kisumu">Kisumu</option>
                   <option value="Homa Bay">Homa Bay</option>
                   <option value="Migori">Migori</option>
                   <option value="Kisii">Kisii</option>
                   <option value="Nyamira">Nyamira</option>
                   <option value="Nairobi (County)">Nairobi (County)</option>
           </select>
           SubCounty:
<input type="name" name="subcounty" placeholder="Enter your SubCounty" class="form-control my-2" value="<?php echo $scounty;?>">
Address:
<input type="text" name="address" placeholder="Enter your Address" class="form-control my-2" value="<?php echo $address;?>">

<?php
}
}
?>
<button class="btn btn-success" name="updatetenants">UPDATE PROFILE</button>
<?php
if(isset($_GET['error'])){
   ?>
<div class="alert alert-danger"><?php echo $_GET['error']; }?></div>

</form>

</div>
</div>
</div>
</div>
</body>

<?php

}//endif session
else{
  header("location: ../admin/login.php");
}


error_reporting(0);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 
?>

