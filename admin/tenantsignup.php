<?php
require_once('includes/dblinkadmin.php');
require_once('includes/header.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
if (isset($_POST['tenantsignup'])) {
	
	if (empty($_POST['gender'])||empty($_POST['contact'])||empty($_POST['lname'])||empty($_POST['sname'])||empty($_POST["idno"])||empty($_POST['fname'])||empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['password2'])||empty($_POST["county"])||empty($_POST["subcounty"])||empty($_POST['address'])||empty($_POST['econtact'])||empty($_POST['guardian'])||empty($_POST['grelation'])||empty($_POST['gcontact'])||empty($_POST['roomno'])||empty($_POST['period'])) {
		header("location: ../admin/tenantsignup.php?error= Please fill in all the above fields ");
		exit();
	}
	else{
	$idno=test_input($_POST["idno"]);	
	$fname=test_input($_POST["fname"]);
	$sname=test_input($_POST["sname"]);
	$lname=test_input($_POST["lname"]);    
	$username= test_input($_POST["username"]);
	$email= test_input($_POST["email"]);
	$password=test_input($_POST["password"]);
	$password2=test_input($_POST["password2"]);
	$gender=test_input($_POST["gender"]);
	$contact=test_input($_POST["contact"]);
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
	if (!preg_match("\\d{10}",$contact))
	{
		header("location: ../admin/tenantsignup.php?error=Invalid contact");
	}
		
	if (empty($_POST["gender"])) {
		header("location: ../admin/tenantsignup.php?error=Gender is required");
	  }
	   else {
		$gender = test_input($_POST["gender"]);
	  }		
	
if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
  header("location: ../admin/tenantsignup.php?error=Only letters and white space allowed");
exit();
}
else if (!preg_match("/^[a-zA-Z]*$/",$sname)) {
	header("location: ../admin/tenantsignup.php?error=Only letters and white space allowed");
  exit();
  }		
  else if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
	header("location: ../admin/tenantsignup.php?error=Only letters and white space allowed");
  exit();
  }		  
 	
 else{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header("location: ../admin/tenantsignup.php?error=Invalid email format");
	exit();
}
else{
			
					if($password!== $password2){
						header("location: ../admin/tenantsignup?error=The passwords do not match");
						exit();
					}
					else{
						
					$sqlsearch3="SELECT id_number FROM tenants WHERE id_number='".$_POST["idno"]."'";
					$result2=mysqli_query($conn,$sqlsearch3);
					if(mysqli_fetch_assoc($result2)){
						header("location: ../admin/tenantsignup.php?error=The Identification Number is already taken");
						exit();
					}
					else{
					$sqlsearch="SELECT username FROM tenants WHERE username='".$username."'";
					$result=mysqli_query($conn,$sqlsearch);
					if(mysqli_fetch_assoc($result)){
						header("location: ../admin/tenantsignup.php?error=The Username is already taken");
						exit();
					}
					else{
					$sqlsearch2="SELECT email FROM tenants WHERE email='".$email."'";
					$result2=mysqli_query($conn,$sqlsearch2);
					if(mysqli_fetch_assoc($result2)){
						header("location: ../admin/tenantsignup.php?error=The Email is already taken");
						exit();
					}
					else{
						$sqlsearch3="SELECT id_number,username,email,contact,rooms_room_number FROM tenants WHERE rooms_room_number='".$_POST["roomno"]."'";
						$result2=mysqli_query($conn,$sqlsearch3);
						if(mysqli_fetch_assoc($result2)){
							 header("location: ../admin/tenantsignup.php?error=The Room is already occupied");
							 exit();
						}

					else{
						$passwordx=password_hash($password, PASSWORD_DEFAULT);
						
						$sql = "INSERT INTO tenants (id_number,first_name,last_name,second_name,username,email,password,gender,contact,county,subcounty,address,emergency_contact,guardian,guardian_relation,guardian_contact,rooms_room_number,stay_from,reg_date) VALUES ('$idno','$fname','$lname','$sname', '$username','$email', '$passwordx','$gender','$contact','$county','$scounty','$address','$econtact','$guardian','$grelation','$gcontact','$roomno','$date2','$date')";
						if (mysqli_query($conn, $sql)) { 
							$sql = "SELECT * FROM tenants WHERE username= '".$username."' OR email='".$email."' LIMIT 1"; 
							$result = mysqli_query($conn, $sql); 
							
							if($row=mysqli_fetch_array($result)){
							
							if(password_verify($password2,$row['password'])){
								
								$sql = "UPDATE rooms SET current_status='OCCUPIED' WHERE room_number= '".$roomno."'"; 
								if (mysqli_query($conn, $sql)) { 
										 header("location: ../admin/tenantsignup.php?error=Record Updated Successfully");

								}    

									else {
									header("location: ../admin/tenantsignup.php?error=Something went wrong please try again");
									exit();
								}    
								header("location: ../admin/tenantsignup.php?error=Tenant registered successfully".mysqli_error($conn));
								exit();
								
							}
							}
					} 
					else {
						header("location: ../admin/tenantsignup.php?error=Something went wrong please try again".mysqli_error($conn));
						exit();
					}    
					}
				}
			}
		}
		}
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

?>
<?php
 //$filepath = realpath(dirname(__FILE__));
 ?>
 <div class="bodycontent">
<div class="container">
	
<div class="row">
	<div class="col-lg-6 m-auto">
		<div class="card bg-light mt-3">
			<div class="card-title bg-primary text-white mt-3">
				<h3 class="text-center py-2">Tenants Sign-Up Form</h3>
			</div>
			
			<div class="card-body">
				<form action="" method="POST" name="form1">
				<input type="name" name="idno" placeholder="Enter your ID Number" class="form-control my-2">
				<input type="name" name="fname" placeholder="Enter your First Name" class="form-control my-2">
				<input type="name" name="sname" placeholder="Enter your Second Name" class="form-control my-2">
				<input type="name" name="lname" placeholder="Enter your Last Name" class="form-control my-2">
				<input type="name" name="username" placeholder="Enter your username" class="form-control my-2">
				<input type="email" name="email" placeholder="Enter your email" class="form-control my-2">
				<input type="password" name="password" placeholder="Enter your password" class="form-control my-2">
				<input type="password" name="password2" placeholder="Re-enter your password" class="form-control my-2" >
								Gender:
				<input type="radio" name="gender" value="Female">Female
				<input type="radio" name="gender" value="Male">Male

				<input type="name" name="contact" placeholder="Enter your Contact" class="form-control my-2">
                <select name="county"  class="form-control">
                        <option value="">Select County of residence</option>
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
<input type="name" name="subcounty" placeholder="Enter your SubCounty" class="form-control my-2">
<input type="text" name="address" placeholder="Enter your Address" class="form-control my-2">
<input type="text" name="econtact" placeholder="Enter your Emergency Contact" class="form-control my-2">
<input type="name" name="guardian" placeholder="Enter your Guardian Names" class="form-control my-2">
<input type="name" name="grelation" placeholder="Enter your Guardian Relation" class="form-control my-2">
<input type="name" name="gcontact" placeholder="Enter your Guardian Contact" class="form-control my-2">
<select name="roomno"  class="form-control">
<option value="">Select A Room</option>
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


                  

<input type="text" name="period" placeholder="Enter the period you wish to begin your stay" class="form-control my-2" onfocus="(this.type='date')">

				<button class="btn btn-success" name="tenantsignup" onclick="check()">SIGN-UP</button>
				
				<?php
				
				if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
			<?php
			}				
?>
		<script>
	function check(){		
		if((document.form1.idno.value.length=="")||(document.form1.fname.value.length=="")||(document.form1.sname.value.length=="")||(document.form1.lname.value.length=="")||(document.form1.username.value.length=="")||(document.form1.email.value.length=="")||(document.form1.contact.value.length=="")||(document.form1.gender.value.length=="")||(document.form1.county.value.length=="")||(document.form1.subcounty.value.length=="")||(document.form1.address.value.length=="")||(document.form1.guardian.value.length=="")||(document.form1.grelation.value.length=="")||(document.form1.econtact.value.length=="")||(document.form1.roomno.value.length=="")||(document.form1.gcontact.value.length=="")||(document.form1.password.value.length=="")||(document.form1.password2.value.length==""))
		{
			alert("Please fill in all the fields");
		}	
	}	
	</script>		
			
				
			</form>
			
			</div>
		</div>
	</div>
</div>
</div>		
<?php
require_once('includes/footer.php');
?>