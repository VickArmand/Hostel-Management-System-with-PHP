<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');
if(isset ($_SESSION['admin'])){
  if(isset ($_POST['viewtenant'])){
    $id=$_POST['tenantid'] ;
    $ret="select tenant_id,id_number,first_name,second_name,last_name,username,email,gender,contact,county,subcounty,address,emergency_contact,guardian,guardian_relation,guardian_contact,rooms_room_number from tenants WHERE tenant_id= '".$id."'";
  
    $res=mysqli_query($conn, $ret);
  if($res)
    {
  while ($row=mysqli_fetch_array($res))
    {
      $id=$row["tenant_id"];
      $idno2=$row["id_number"];
      $fname2=$row["first_name"];
      $sname2=$row["second_name"];
      $lname2=$row["last_name"];
      $contact2=$row["contact"];
     $address2=$row["address"];
    $roomno2=$row["rooms_room_number"];
    $email2=$row["email"];
   $county2=$row["county"];
   $scounty2=$row["subcounty"];
  $guardian2=$row["guardian"];
  $grelation2=$row["guardian_relation"];
    $uname2=$row["username"];
    $econtact2=$row["emergency_contact"];
  $gcontact2=$row["guardian_contact"];
    $gender=$row["gender"];
    $pno2=$row["contact"];
   
    
  }
  }
  }
    if(isset($_POST["updatetenant"]))
    {

      
        if (empty($_POST['tenantid'])||empty($_POST['idno'])||empty($_POST['fname'])||empty($_POST['sname'])||empty($_POST["lname"])||empty($_POST['pno'])||empty($_POST['gender'])||empty($_POST['uname'])||empty($_POST['email'])||empty($_POST["county"])||empty($_POST["subcounty"])||empty($_POST['address'])||empty($_POST['econtact'])||empty($_POST['guardian'])||empty($_POST['grelation'])||empty($_POST['gcontact'])||empty($_POST['roomno'])) {
            
            header("location: ../admin/tenantsedit.php?error= Please fill in all the above fields ");
      exit();
  
        }
       
        
     if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
        header("location: ../admin/tenantsedit.php?error=Only letters and white space allowed");
      exit();
      }
      else if (!preg_match("/^[a-zA-Z]*$/",$sname)) {
        header("location: ../admin/tenantsedit.php?error=Only letters and white space allowed");
        exit();
        }		
        else if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
        header("location: ../admin/tenantsedit.php?error=Only letters and white space allowed");
        exit();
        }		  
        
        else{
          $tenantid=$_POST["tenantid"];
          $check2= mysqli_query($conn,"select id_number,username,email,contact,rooms_room_number from tenants where tenant_id=".$tenantid.""); 
          if(mysqli_num_rows($check2)){


				
		          
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
header("location: ../admin/tenantsedit?error=Record Updated Successfully");

}    

else {
header("location: ../admin/tenantsedit?error=Something went wrong please try again");
exit();
}    
 
$idno=test_input($_POST["idno"]);	
$fname=test_input($_POST["fname"]);
$sname=test_input($_POST["sname"]);
$lname=test_input($_POST["lname"]);    
$username= test_input($_POST["uname"]);
$email= test_input($_POST["email"]);

$gender=test_input($_POST["gender"]);
$contact=test_input($_POST["pno"]);
$county=test_input($_POST["county"]);
$scounty=test_input($_POST["subcounty"]);
$address=test_input($_POST["address"]);
$econtact=test_input($_POST["econtact"]);
$guardian=test_input($_POST["guardian"]);
$grelation=test_input($_POST["grelation"]);
$gcontact=test_input($_POST["gcontact"]);
$roomno=test_input($_POST["roomno"]);
$date2=test_input($_POST["period"]);
$date=date("Y-m-d h:i:sa");
                        $sql = "UPDATE tenants SET username='".$username."',id_number='".$idno."',first_name='".$fname."',second_name='".$sname."',last_name='".$lname."',contact='".$contact."',amount_paid='".$rent."',balance='".$bal."',payment_means='".$means."',rent_status='".$status."',rooms_room_number='".$rno."',period='".$period."',update_date='".$date."' WHERE id= '".$id2."'"; 
                        
                        if (mysqli_query($conn, $sql)) { 

                                          $sql = "UPDATE rooms SET current_status='OCCUPIED' WHERE room_number= '".$roomno."'"; 
                                          if (mysqli_query($conn, $sql)) { 
                                              header("location: ../admin/tenantsedit?error=Record Updated Successfully");
                          
                                          }    
                          
                                            else {
                                            header("location: ../admin/tenantsedit?error=Something went wrong please try again");
                                            exit();
                                          }    
                             header("location: ../admin/tenantsedit.php?error=Record Updated Successfully");
  
                        }    
        
                    else {
          header("location: ../admin/tenantsedit.php?error=Something went wrong please try again");
          exit();
              
        }














          }
          else{

            header("location: ../admin/tenantsedit.php?error=Record not available");
            exit();
 
       }   
      
        }

      }
    }
else{
  header("location: ../admin/login.php");
}







error_reporting(0);
?>
 <body>
 <div class="bodycontent">
 <div class="container">

<div class="row">
    <div class="col-lg-6 m-auto">
<form method="POST" action="" name="form1">
<input type="hidden" name="tenantid" value="<?php echo $id;?>" >
ID Number:<input type="text" value="<?php echo $idno2;?>"placeholder="Enter the ID Number" class="form-control my-2" name="idno">
First Name:<input type="text" value="<?php echo $fname2;?>"placeholder="Enter the First Name" class="form-control my-2" name="fname">
Second Name:<input type="text" value="<?php echo $sname2;?>"placeholder="Enter the Middle Name" class="form-control my-2"name="sname" >
Surname:<input type="text" value="<?php echo $lname2;?>"placeholder="Enter the Surname" class="form-control my-2" name="lname">
Username<input type="text" value="<?php echo $uname2;?>"placeholder="Enter the Username" class="form-control my-2" name="uname">
Email Address:<input type="text" value="<?php echo $email2;?>"placeholder="Enter the Email Address" class="form-control my-2"name="email">
Phone Number:<input type="text" value="<?php echo $contact2;?>"placeholder="Enter the Phone Number" class="form-control my-2"name="pno">
Gender: <input type="radio"  <?php if($gender == "Female") { echo "checked"; }?> name="gender" value="Female"> Female
<input type="radio" <?php if($gender == "Male") { echo "checked"; }?> name="gender" value="Male"> Male
<br>
                Select County of residence:    <select name="county"  class="form-control">
                        <option value="<?php echo $county2;?>"><?php echo $county2;?></option>
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
Sub County: <input type="name" name="subcounty"value="<?php echo $scounty2;?>" placeholder="Enter your SubCounty" class="form-control my-2">
Address: <input type="text" name="address" value="<?php echo $address2;?>"placeholder="Enter your Address" class="form-control my-2">
Emergency Contact:<input type="text" name="econtact"value="<?php echo $econtact2;?>" placeholder="Enter your Emergency Contact" class="form-control my-2">
Guardian: <input type="name" name="guardian"value="<?php echo $guardian2;?>" value="<?php echo $pno2;?>"placeholder="Enter your Guardian Names" class="form-control my-2">
Guardian Relation:<input type="name" name="grelation" value="<?php echo $grelation2;?>"placeholder="Enter your Guardian Relation" class="form-control my-2">
Guardian Contact:<input type="name" name="gcontact" value="<?php echo $gcontact2;?>"placeholder="Enter your Guardian Contact" class="form-control my-2">
Select A Room:
<select name="roomno"  class="form-control">
<option value="<?php echo $roomno2;?>" ><?php echo $roomno2;?></option>
<?php
 $sql = "SELECT room_number FROM rooms "; 
 $result = mysqli_query($conn, $sql); 
 
if($result)
                    {
                        while ($row=mysqli_fetch_array($result))
                        {
                            $roomno=$row["room_number"];
                           


                           echo"<option >$roomno</option>";


                        }
                    }
?>
</select>


<br>
<button class="btn btn-success" name="updatetenant" >UPDATE PROFILE</button>
<?php
if(isset($_GET['error'])){
               ?>
               
           <div class="alert alert-danger"><?php echo $_GET['error']  ?></div>
           <?php
            }
          
          
?>
</form>

            
          </div>          
</div>
</div>
</div>
</body>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 ?>