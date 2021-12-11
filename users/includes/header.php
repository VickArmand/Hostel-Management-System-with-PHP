<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/css/bootstrap.css">
    
</head>
<body style="background: #CCC;">
<span class="header">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container">
      <a href="#" class="navbar-brand"><h3>Hostel Management System</h3></a>

  <ul class="nav navbar ml-auto navbar-right">
   

    <?php
    session_start();
   
    if (isset($_SESSION['users']))
    {
?>
<li><a href="../users/logout.php" type="button" class="btn btn-outline-light ml-3">Log Out</a></li>
<?php
    }
    else{
?>
<ul>

<li><a href="../users/login.php" type="button" class="btn btn-outline-light ml-3">Log In</a></li>
</ul>
<?php    
}
    
    ?>
  </ul>
  
  </div>
    </div>

  </nav>
  </span>
  <script src="includes/js/jquery.js"></script>

    <script src="js/bootstrap.js"></script>
  </body>
</html>