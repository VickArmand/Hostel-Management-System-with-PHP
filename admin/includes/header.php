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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
      <div class="container">
      <a href="#" class="navbar-brand"><h3>Hostel Management System</h3></a>
<nav id ="hamburger"> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button></nav>
  <ul class="nav navbar ml-auto navbar-right">
   

    <?php
    
   session_start();
    if (isset($_SESSION['admin']))
    {
?>
<li><a href="../admin/logout.php" type="button" class="btn btn-outline-light ml-3">Log Out</a></li>
<?php
    }
    else{
?>
<ul>

<li><a href="../admin/login.php" type="button" class="btn btn-outline-light ml-3">Log In</a></li>
</ul>
<?php    
}
    
    ?>
  </ul>
  
  </div>
    </div>

  </nav>
  </span>
    <script src="includes/js/bootstrap.js"></script>
    <script src="includes/js/jquery.js"></script>

  </body>
