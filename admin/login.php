<?php
date_default_timezone_set('Africa/Nairobi');
require_once('includes/dblinkadmin.php');
require_once('includes/header.php');

if (isset($_POST['adminlogin'])) { 
	
	if (empty($_POST['username'])||empty($_POST['password'])) {
		header("location: ../admin/login.php?error=Please fill in the above fields");
		exit();
	}
	
	else{
		$username=test_input($_POST['username']);
		$password2=test_input($_POST['password']);
		$password3= password_hash($password2,PASSWORD_DEFAULT);
		$date=date("Y-m-d h:i:sa");
		$sql = "SELECT admin_id,email,username,password FROM admin WHERE username= '".$username."' OR email='".$username."' LIMIT 1"; 
		$result = mysqli_query($conn, $sql); 
		
		if($row=mysqli_fetch_array($result)){
			$email=$row["email"]; 
			$idno=$row["admin_id"];      
			$uname=$row["username"];
			
			$ip = getIPAddress(); 
		  if(password_verify($password2,$row['password'])){
			$_SESSION ['adminid']=$row['admin_id'];
            $_SESSION ['admin']=$row['username'];
            $_SESSION ['email']=$row['email'];
			header("location: ../admin/dashboard.php?error=success");
			
			$sql_2="INSERT INTO adminlog(admin_admin_id,ip,login_time,logout_time) VALUES ('$idno','$ip','$date','')";
			
			$res=mysqli_query($conn, $sql_2);
			if ($res)
			{
				header("location: ../admin/dashboard.php?error=Insert success");
			}
		  }
		  else{	  
			header("location: ../admin/login.php?error=Incorrect username or password");
			exit();
			
		  }
		 
		
		}
		else{
		  header("location: ../admin/login.php?error=Please Sign up");
		  exit();
		}
		  
	  
	}

}

	


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
} 
    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
 

  
$conn->close();

	 
?>
<?php
?>
 <div class="bodycontent">
<div class="container">
	
<div class="row">
	<div class="col-lg-6 m-auto">

		<div class="card bg-light mt-5">
		<a href="../index.php" class="btn btn-secondary ml 3" >Go Back</a>
			<div class="card-title bg-primary text-white mt-5">
			
				<h3 class="text-center py-2">Admin Login Form</h3>
			</div>
			<div class="card-body">
				<form action="login.php" method="POST" name="form1">
				<input type="name" name="username" placeholder="Enter your username or email" class="form-control mb-2">
				
				<input type="password" name="password" placeholder="Enter your password" class="form-control mb-2">
				
				<button class="btn btn-success" name="adminlogin" onclick="check()" class="pt-3">LOGIN</button>
				<br><a href="forgotpassword.php">Forgot password?</a></p>

				
			</form>
			<?php
				if(isset($_GET['error'])){
				?>
			<div class="alert alert-danger"><?php echo $_GET['error'] ?></div>
			<?php
			}				
?>
		<script>
	function check(){		
		if((document.form1.username.value.length=="")||(document.form1.password.value.length==""))
		{
			alert("Please fill in all the fields");
		}	
	}	
	</script>		
				
				
				
		</div>
	</div>
	
<?php
require_once('includes/footer.php');
?>