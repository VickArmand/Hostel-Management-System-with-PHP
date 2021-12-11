<?php
date_default_timezone_set('Africa/Nairobi');
require_once('includes/header.php');

require_once('includes/dblinkusers.php');
?>
<html>

<body>
<div class="container">
<div class="row">
<div class="col-lg-6 m-auto">
<div class="card bg-light mt-5">
<div class="card-title bg-primary text-white mt-2">
<h3 class="text-center py-2">
Reset Password</h3>
    </div>
    
        <div class="card-body">
<form action="" name="resetpwd" method="POST">
<label for="email">Email</label>
<input type="email" name="email" class="form-control mb-2" >
<br>
<label for="pwd1">Password</label>
<input type="password" name="pwd1" class="form-control mb-2" >
<br>
<label for="pwdconfirm">Confirm Password</label>
<input type="password" name="pwdconfirm" class="form-control mb-2" >
<br>
<input type="submit" class="btn btn-success" value="Submit">


</form>
</div>
</div>
</div>

</div>    


</body>



</html>