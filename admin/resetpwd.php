<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');
require_once('includes/dblinkadmin.php');

if(isset ($_SESSION['admin'])){
if (isset($_POST['changepwd'])) { 
	
	if (empty($_POST['password'])||empty($_POST['pwd2'])||empty($_POST['pwd2confirm'])){
		header("location: ../admin/resetpwd.php?error=Please fill in the above fields");
		exit();
	}
	
	else{
        if($_POST['pwd2']!== $_POST['pwd2confirm']){
            header("location: ../admin/resetpwd.php?error=The passwords do not match");
            exit();
        }
        elseif(($_POST['password']== $_POST['pwd2'])||($_POST['password']== $_POST['pwd2confirm'])){
          header("location: ../admin/resetpwd.php?error=The old password and new password should not be the same");
          exit();
        }
            else{
		$pwd1=test_input($_POST['password']);
		$pwd2=test_input($_POST['pwd2']);
    $pwd3= test_input($_POST["pwd2confirm"]);
    $activeuser=$_SESSION['admin'];
    $date=date("Y-m-d h:i:sa");
		$sql = "SELECT password FROM admin WHERE username= '".$activeuser."'"; 
		$result = mysqli_query($conn, $sql); 
		
		if($row=mysqli_fetch_array($result)){
            
		  if(password_verify($pwd1,$row['password'])){
            $pwd2x= password_hash($pwd2,PASSWORD_DEFAULT);
              $sql2="UPDATE admin SET password='".$pwd2x."',update_date='".$date."' WHERE username='".$activeuser."'";
              if(mysqli_query($conn, $sql2))
              {
              	header("location: ../admin/resetpwd.php?error=Update Success");
			          exit();
              }
              else{	  
                header("location: ../admin/resetpwd.php?error=Something went wrong please try again".mysqli_error($conn));
                exit();
                
              } 
		  }
		  else{	  
			header("location: ../admin/resetpwd.php?error=Incorrect details");
			exit();
			
		  }
        }
		
		
		else{
		  header("location: ../admin/resetpwd.php?error=Please Sign Up Or Log In If you have an account");
		  exit();
		}
		  
	  
	}

}

}	
}
else{
	
	header("location: ../index.php");
	exit();
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$conn->close();
	 
?>
 <div class="bodycontent">
<div class="container">
	
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card bg-light mt-5">
                <div class="card-body">
                    <form method="POST" name="changepwd">
                    <input type="password" name="password" placeholder="Enter your current password" class="form-control mb-2">
                    <input type="password" name="pwd2" placeholder="Enter a new password" class="form-control mb-2">
                    <input type="password" name="pwd2confirm" placeholder="Confirm the new password" class="form-control mb-2">
                    
                    <button class="btn btn-success" name="changepwd" class="pt-3" onclick="check()">CHANGE PASSWORD</button>
                    
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
                if((document.changepwd.password.value.length=="")||(document.changepwd.pwd2.value.length=="")||(document.changepwd.pwd2confirm.value.length==""))
                {
                  alert("Please fill in all the fields");

                }
               }
                </script>  
                    
                    
                    
            </div>
        </div>
    </div>
    </div>
              </div>		