<link rel="stylesheet" type="text/css" href="includes/css/style.css">
<link rel="stylesheet" href="includes/css/bootstrap.css">
<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<?PHP if(isset($_SESSION['users']))
				{ ?>
<li><a href="../users/dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
<li><a href="../users/myprofile.php"><i class="fa fa-user"></i>Edit your Profile</a></li>
<li><a href="../users/resetpwd.php"><i class="fa fa-files-o"></i>Change Password</a></li>
<li><a href="../users/rooms.php"><i class="fa fa-file-o"></i>Rooms Available</a></li>
<?php }

else { ?>
				
				<li><a href="users/login.php"><i class="fa fa-users"></i> User Login</a></li>
				<li><a href="admin/admin.php"><i class="fa fa-user"></i> Admin Login</a></li>
				
				<?php } ?>

			</ul>
		</nav> 