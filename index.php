<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {

	 include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

	if ($_SESSION['role'] == "admin") {
		  $todaydue_task = count_tasks_due_today($conn);
	     $overdue_task = count_tasks_overdue($conn);
	     $nodeadline_task = count_tasks_NoDeadline($conn);
	     $num_task = count_tasks($conn);
	     $num_users = count_users($conn);
	     $pending = count_pending_tasks($conn);
	     $in_progress = count_in_progress_tasks($conn);
	     $completed = count_completed_tasks($conn);
	}else {
        $num_my_task = count_my_tasks($conn, $_SESSION['id']);
        $overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
        $pending = count_my_pending_tasks($conn, $_SESSION['id']);
	     $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
	     $completed = count_my_completed_tasks($conn, $_SESSION['id']);

	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
	<style>
		* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

		body {
            background: #f5f7fa;
        }

        .body {
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

		.dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

		.dashboard-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            cursor: pointer;
            animation: slideUp 0.6s ease-in-out;
        }

        .dashboard-item:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        .dashboard-item i {
            font-size: 30px;
            color: #007BFF;
            margin-bottom: 10px;
        }

        .dashboard-item span {
            font-weight: 600;
            color: #333;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
	</style>
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<?php if ($_SESSION['role'] == "admin") { ?>
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-users"></i>
						<span><?=$num_users?> Employee</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span><?=$num_task?> All Tasks</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-window-close-o"></i>
						<span><?=$overdue_task?> Overdue</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-clock-o"></i>
						<span><?=$nodeadline_task?> No Deadline</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-exclamation-triangle"></i>
						<span><?=$todaydue_task?> Due Today</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-bell"></i>
						<span><?=$overdue_task?> Notifications</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-square-o"></i>
						<span><?=$pending?> Pending</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-spinner"></i>
						<span><?=$in_progress?> In progress</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-check-square-o"></i>
						<span><?=$completed?> Completed</span>
					</div>
				</div>
			<?php }else{ ?>
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span><?=$num_my_task?> My Tasks</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-window-close-o"></i>
						<span><?=$overdue_task?> Overdue</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-clock-o"></i>
						<span><?=$nodeadline_task?> No Deadline</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-square-o"></i>
						<span><?=$pending?> Pending</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-spinner"></i>
						<span><?=$in_progress?> In progress</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-check-square-o"></i>
						<span><?=$completed?> Completed</span>
					</div>
				</div>
			<?php } ?>
		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(1)");
	active.classList.add("active");
</script>
</body>
</html>
<?php }else{ 
   $em = "First login";
   header("Location: login.php?error=$em");
   exit();
}
 ?>