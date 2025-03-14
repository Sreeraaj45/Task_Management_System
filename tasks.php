<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";
    
    $text = "All Task";
    if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
    	$text = "Due Today";
      $tasks = get_all_tasks_due_today($conn);
      $num_task = count_tasks_due_today($conn);

    }else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
    	$text = "Overdue";
      $tasks = get_all_tasks_overdue($conn);
      $num_task = count_tasks_overdue($conn);

    }else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
    	$text = "No Deadline";
      $tasks = get_all_tasks_NoDeadline($conn);
      $num_task = count_tasks_NoDeadline($conn);

    }else{
    	 $tasks = get_all_tasks($conn);
       $num_task = count_tasks($conn);
    }
    $users = get_all_users($conn);
    

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>All Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

		* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: 'Poppins', sans-serif;
		}

		body {
            background: #f5f7fa;
            display: flex;
            flex-direction: column;
        }

        .body {
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

		.title-2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .title-2 a {
            text-decoration: none;
            background: #007BFF;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s ease-in-out;
        }

        .title-2 a:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

		.success {
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }

		.main-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            animation: slideUp 0.6s ease-in-out;
        }

        .main-table th, .main-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .main-table th {
            background: #007BFF;
            color: white;
            font-weight: 600;
        }

        .main-table tr:hover {
            background: #f1f1f1;
            transition: 0.3s ease-in-out;
        }

        .edit-btn, .delete-btn {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s ease-in-out;
        }

		.edit-btn {
            background: #007bff;
            color: white;
        }

        .edit-btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .delete-btn {
            background: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background: #a71d2a;
            transform: scale(1.05);
        }

		/* Task Status Colors */
        .status-Pending { color: #ff9800; font-weight: bold; }
        .status-Completed { color: #28a745; font-weight: bold; }
        .status-InProgress { color: #007bff; font-weight: bold; }

        h3 {
            text-align: center;
            color: #666;
            font-weight: 400;
            animation: fadeIn 0.6s ease-in-out;
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
			<h4 class="title-2">
				<a href="create_task.php" class="btn">Create Task</a>
				<a href="tasks.php?due_date=Due Today">Due Today</a>
				<a href="tasks.php?due_date=Overdue">Overdue</a>
				<a href="tasks.php?due_date=No Deadline">No Deadline</a>
				<a href="tasks.php">All Tasks</a>
 
			</h4>
         <h4 class="title-2"><?=$text?> (<?=$num_task?>)</h4>
			<?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>
			<?php if ($tasks != 0) { ?>
			<table class="main-table">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Assigned To</th>
					<th>Due Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php $i=0; foreach ($tasks as $task) { ?>
				<tr>
					<td><?=++$i?></td>
					<td><?=$task['title']?></td>
					<td><?=$task['description']?></td>
					<td>
						<?php 
                  foreach ($users as $user) {
						if($user['id'] == $task['assigned_to']){
							echo $user['full_name'];
						}}?>
	            </td>
	            <td><?php if($task['due_date'] == "") echo "No Deadline";
	                      else echo $task['due_date'];
	               ?></td>
	            <td><?=$task['status']?></td>
					<td>
						<a href="edit-task.php?id=<?=$task['id']?>" class="edit-btn">Edit</a>
						<a href="delete-task.php?id=<?=$task['id']?>" class="delete-btn">Delete</a>
					</td>
				</tr>
			   <?php	} ?>
			</table>
		<?php }else { ?>
			<h3>Empty</h3>
		<?php  }?>
			
		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(4)");
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