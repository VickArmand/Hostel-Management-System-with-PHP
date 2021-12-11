<link rel="stylesheet" type="text/css" href="includes/css/style.css">
<link rel="stylesheet" href="includes/css/bootstrap.css">

 
<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<?PHP  if(isset($_SESSION['admin']))
				{ ?>
<li><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
<li><a href="myprofile.php"><i class="fa fa-user"></i> Edit your Profile</a></li>
<li><a href="resetpwd.php"><i class="fa fa-files-o"></i>Change Password</a></li>
<li><a href=""><i class="fa fa-file-o"></i>Tenants</a><ul>
        <li><a href="tenantsignup.php"><i class="fa fa-file-o"></i>Tenant Registration</a></li>
		<li><a href="tenants.php"><i class="fa fa-file-o"></i>Manage Tenants</a></li>
		<li><a href="accesslogs.php"><i class="fa fa-file-o"></i>Tenants Logs</a></li>
</ul></li>

<li><a href=""><i class="fa fa-file-o"></i>Rooms<span class="fas fa-caret-down"></span></a><ul>
						<li><a href="roomadd.php">Add a Room</a></li>
						<li><a href="roommgmt.php">Manage Rooms</a></li>
</ul></li>
<li><a href=""><i class="fa fa-file-o"></i>Admin</a><ul>
			<li><a href="signup.php">Admin Registration</a></li>
			<li><a href="adminmgmt.php">Manage Admins</a></li>
			<li><a href="adminaccesslogs.php"><i class="fa fa-file-o"></i>Admin Access logs</a></li>
</ul></li>
<?php } 
else { ?>
				
				
				<li><a href="users/login.php"><i class="fa fa-users"></i> User Login</a></li>
				<li><a href="admin/login.php"><i class="fa fa-user"></i> Admin Login</a></li>
				
				<?php } ?>

			</ul>
		</nav> 
	