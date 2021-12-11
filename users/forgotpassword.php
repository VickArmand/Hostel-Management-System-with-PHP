<?php
date_default_timezone_set('Africa/Nairobi');
require_once('includes/header.php');

require_once('includes/dblinkusers.php');
if(isset($_POST["forgotpwd"])){
$email=$_POST["email"];
$query="SELECT email FROM tenants WHERE email='".$email."'";
$result=mysqli_query($conn,$query);
if($row=mysqli_fetch_array($result)){
    



    
    echo"<script>alert('Link sent to this email');</script>";
    
}
else{
    
    echo"<div class='alert alert-danger'>User Not Found</div>";

}
}
?>
<html>
<body>
    <div class="bodycontent">
  <div class="container">
  <div class="row">
	<div class="col-lg-6 m-auto">
	
		<div class="card bg-light mt-5">
  <a href="../index.php" class="btn btn-secondary ml 3" >Go Back</a>

<div class="card-title bg-primary text-white mt-2">

    <h3 class="text-center py-2">Forgot Password</h3>
</div>
<form action="" method="POST"class="emailform" >
<label for="email">Enter your email address</label>
<input type="email" name="email" class="form-control mb-2 "><br>
<input type="submit" class="btn btn-success"  name="forgotpwd" value="Submit">





</form>

  </div>  

  </div>

</body>


<script>
$(document).ready(function(){

    $(".emailform").on('submit',function(e){
       
        if ($('input[type=email]').val().length<1)
        {
            alert("Please fill in the fields");
           e.preventDefault();
        }
        else{
            $("input:submit").val("Please Wait..");
           $("input:submit").attr("disabled",true);

            $.ajax({
            url:"./forgotpassword.php",
            type:"POST",
            data:$(".emailform").serialize(),
            success:function(result){alert(result);},
            error:function(){alert("Error");}
            });
        
        }
       
    });
});

</script>


</html>