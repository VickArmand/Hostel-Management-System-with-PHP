<?php
require_once('includes/header.php');
require_once('includes/dblinkadmin.php');
require_once('includes/sidebar.php');
if(isset ($_SESSION['admin'])){
        
	if (isset($_POST['adminsignup'])) {
		if (empty($_POST['gender'])||empty($_POST['contact'])||empty($_POST['lname'])||empty($_POST['sname'])||empty($_POST["idno"])||empty($_POST['fname'])||empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['password2'])) {
			header("location: ../admin/signup.php?error= Please fill in all the above fields ");
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
			$date=date("Y-m-d h:i:sa");
		
			if (!preg_match("\\d{10}",$contact))
			{
				header("location: ../admin/signup.php?error=Invalid contact");
			}	
		
		if (!preg_match("/^[a-zA-Z]*$/",$fname)) {
		  header("location: ../admin/signup.php?error=Only letters and white space allowed");
		exit();
		}
		else if (!preg_match("/^[a-zA-Z]*$/",$sname)) {
			header("location: ../admin/signup.php?error=Only letters and white space allowed");
		  exit();
		  }		
		  else if (!preg_match("/^[a-zA-Z]*$/",$lname)) {
			header("location: ../admin/signup.php?error=Only letters and white space allowed");
		  exit();
		  }		  
		  
		 else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("location: ../admin/signup.php?error=Invalid email format");
			exit();
		}
	else{
				
						if($password!== $password2){
							header("location: ../admin/signup.php?error=The passwords do not match");
							exit();
						}
						else{
							$sqlsearch3="SELECT ID_number FROM admin WHERE id_number='".$_POST["idno"]."'";
					$result2=mysqli_query($conn,$sqlsearch3);
					if(mysqli_fetch_assoc($result2)){
						header("location: ../admin/tenantsignup.php?error=The Identification Number is already taken");
						exit();
                    }
                    else{
					
						$sqlsearch="SELECT username FROM admin WHERE username='".$username."'";
						$result=mysqli_query($conn,$sqlsearch);
						if(mysqli_fetch_assoc($result)){
							header("location: ../admin/signup.php?error=The Username is already taken");
							exit();
						}
						else{
						$sqlsearch2="SELECT email FROM admin WHERE email='".$email."'";
						$result2=mysqli_query($conn,$sqlsearch2);
						if(mysqli_fetch_assoc($result2)){
							header("location: ../admin/signup.php?error=The Email is already taken");
							exit();
						}
						else{
							$passwordx=password_hash($password, PASSWORD_DEFAULT);
							
							$sql = "INSERT INTO admin (email,first_name,second_name,last_name,password,username,gender,contact,ID_number,reg_date,update_date) VALUES ('$email','$fname','$sname','$lname','$passwordx', '$username','$gender','$contact','$idno','$date','')";
							if (mysqli_query($conn, $sql)) { 
								$sql = "SELECT * FROM admin WHERE username= '".$username."' OR email='".$email."' LIMIT 1"; 
							$result = mysqli_query($conn, $sql); 
							
							if($row=mysqli_fetch_array($result)){
								if(password_verify($password2,$row['password'])){
									
								
								header("location: ../admin/signup.php?error=Admin Registered Successfully");
								exit();
								}
							}
						} else {
							header("location: ../admin/signup.php?error=Something went wrong please try again");
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
 
 require_once('includes/header.php');
 ?>
 <div class="bodycontent">
<div class="container">
	
<div class="row">
	<div class="col-lg-6 m-auto">
		<div class="card bg-light mt-3">
			<div class="card-title bg-primary text-white mt-3">
				<h3 class="text-center py-2"> ADMIN REGISTRATION FORM</h3>
			</div>
			
			<div class="card-body">
				<form action="signup.php" method="POST" name="form1">
				ID Number:<input type="name" name="idno" placeholder="Enter your ID Number" class="form-control my-2">
				First Name:<input type="name" name="fname" placeholder="Enter your First Name" class="form-control my-2">
				Second Name:<input type="name" name="sname" placeholder="Enter your Second Name" class="form-control my-2">
				Last Name:<input type="name" name="lname" placeholder="Enter your Last Name" class="form-control my-2">
				Username:<input type="name" name="username" placeholder="Enter your username" class="form-control my-2">
				Email:<input type="email" name="email" placeholder="Enter your email" class="form-control my-2">
				Password:<input type="password" name="password" placeholder="Enter your password" class="form-control my-2">
				Confirm Password:<input type="password" name="password2" placeholder="Re-enter your password" class="form-control my-2" >
								Gender:
				<input type="radio" name="gender" value="Female"> Female
				<input type="radio" name="gender" value="Male"> Male
<br>
				Phone Number:<input type="name" name="contact" placeholder="Enter your Contact" class="form-control my-2">

				<button class="btn btn-success" name="adminsignup" onclick="check()">REGISTER ADMIN</button>
				<?php
				
				if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
			<?php
			}				
?>
			
			<script>
	function check(){		
		if((document.form1.idno.value.length=="")||(document.form1.fname.value.length=="")||(document.form1.sname.value.length=="")||(document.form1.lname.value.length=="")||(document.form1.username.value.length=="")||(document.form1.email.value.length=="")||(document.form1.contact.value.length=="")||(document.form1.gender.value.length=="")||(document.form1.password.value.length=="")||(document.form1.password2.value.length==""))
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