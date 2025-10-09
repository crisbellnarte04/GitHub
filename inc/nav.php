<style>
	a{
		text-decoration:none;
		color: white;
	}
</style>
<nav class="side-bar">
			<div class="user-p">
				<img src="img/avatar.png">
				<h4><?=$_SESSION['username']?></h4>
				<span><?=$_SESSION['username']?></span>
			</div>
			
			<?php 

               if($_SESSION['role'] == "employee"){
			 ?>
			 <!-- Employee Navigation Bar -->
			<ul id="navList">
				<a href="index.php" >
				<li>
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</li>
				</a> 
				<a href="profile.php">
				<li>
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>Profile</span>
					</li>
				</a>
				<a href="my_task.php">
				<li>
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span>My Task</span>
					</li>
				</a>
				<a href="notifications.php">
				<li>
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</li>
				</a>
				<!-- <a href="user-book.php">
				<li>
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span>Book Apointment</span>
					</li>
				</a> -->
				<a href="logout.php">
				<li>
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</li>
				</a>
			</ul>
		<?php }else  if($_SESSION['role'] == "admin") { ?>
			<!-- Admin Navigation Bar -->
            <ul id="navList">
				<a href="index.php">
				<li>
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</li>
				</a>
				<a href="user.php">
				<li>
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Manage Users</span>
					</li>
				</a>
				<a href="create_task.php">
				<li>
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Create Task</span>
					</li>
				</a>
				<a href="task.php">
				<li>
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>All Tasks</span>
					</li>
				</a>
				<a href="notifications.php">
				<li>
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</li>
				</a>
				<a href="admin_appointment.php">
				<li>
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span>Appointments</span>
					</li>
				</a>
				<a href="logout.php">
				<li>
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</li>
				</a>
			</ul>
		
		<?php } else  if($_SESSION['role'] == "doctor") { ?>
			<!-- Admin Navigation Bar -->
            <ul id="navList">
				<a href="index.php">
				<li>
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</li>
				</a>
			
				<a href="doc_appointment.php">
				<li>
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span>Appointments</span>
					</li>
				</a>
				<a href="logout.php">
				<li>
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</li>
				</a>
			</ul>
		<?php } ?>
		</nav>