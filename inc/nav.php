<nav class="side-bar">
			<div class="user-p">
				<img src="img/user.png">
				<h4>@<?=$_SESSION['username']?></h4>
			</div>
			
			<?php 

               if($_SESSION['role'] == "employee"){
			 ?>
			 <!-- Employee Navigation Bar -->
			<ul id="navList">
				<li>
					<a href="index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="my_task.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>My Task</span>
					</a>
				</li>
				<li>
					<a href="profile.php">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a href="notifications.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		<?php }else { ?>
			<!-- Admin Navigation Bar -->
            <ul id="navList">
				<li>
					<a href="index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="user.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Manage Users</span>
					</a>
				</li>
				<li>
					<a href="create_task.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Create Task</span>
					</a>
				</li>
				<li>
					<a href="tasks.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>All Tasks</span>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		<?php } ?>
		</nav>

<style>
	* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

	.side-bar {
        width: 250px;
        height: 100vh;
        background: #007BFF;
        padding-top: 20px;
        color: white;
        box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

	.user-p {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-p img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid white;
        transition: transform 0.3s ease-in-out;
    }

	.user-p img:hover {
        transform: scale(1.1);
    }

    .user-p h4 {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 600;
    }

	#navList {
        list-style: none;
        padding: 0;
        margin: 0;
    }

	#navList li {
        margin: 10px 0;
    }

	#navList li a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: 500;
        border-radius: 5px;
        transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
    }

	/* #navList li a:hover {
        background-color: #FFD700;
        transform: scale(1.05);
    } */

	#navList li a i {
        font-size: 18px;
        margin-right: 10px;
    }

	/* Active link style */
    #navList li a.active {
        background-color: #FFD700;
    }

	@keyframes fadeIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-100px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .side-bar {
        animation: slideIn 0.5s ease-in-out;
    }

    .user-p, #navList li {
        animation: fadeIn 0.8s ease-in-out;
    }

</style>