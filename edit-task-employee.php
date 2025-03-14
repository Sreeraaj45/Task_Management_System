<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";
    
    if (!isset($_GET['id'])) {
    	 header("Location: tasks.php");
    	 exit();
    }
    $id = $_GET['id'];
    $task = get_task_by_id($conn, $id);

    if ($task == 0) {
    	 header("Location: tasks.php");
    	 exit();
    }
   $users = get_all_users($conn);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Task</title>
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
            display: flex;
            flex-direction: column;
        }

		.body {
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

		h4.title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            margin-bottom: 15px;
        }

        h4.title a {
            text-decoration: none;
            background: #007BFF;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s ease-in-out;
        }

        h4.title a:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .success, .danger {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }

        .success {
            background: #28a745;
            color: white;
        }

        .danger {
            background: #dc3545;
            color: white;
        }

        .form-1 {
            display: flex;
            flex-direction: column;
            gap: 12px;
            animation: slideUp 0.6s ease-in-out;
        }

        .task-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            border-left: 5px solid #007BFF;
        }

        .task-details p {
            margin: 5px 0;
        }

        .input-holder {
            display: flex;
            flex-direction: column;
        }

        .input-holder label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .input-1 {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .input-1:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        .edit-btn {
            display: inline-block;
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .edit-btn:hover {
            background: #0056b3;
            transform: scale(1.05);
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
			<h4 class="title">Edit Task <a href="my_task.php">Back</a></h4>
			<form class="form-1"
			      method="POST"
			      action="app/update-task-employee.php">
			      <?php if (isset($_GET['error'])) {?>
      	  	<div class="danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } ?>
				<div class="input-holder">
					<lable></lable>
					<p><b>Title: </b><?=$task['title']?></p>
				</div>
				<div class="input-holder">
					<lable></lable>
					<p><b>Description: </b><?=$task['description']?></p>
				</div><br>
            <div class="input-holder">
					<lable>Status</lable>
					<select name="status" class="input-1">
						<option 
						      <?php if( $task['status'] == "pending") echo"selected"; ?> >pending</option>
						<option <?php if( $task['status'] == "in_progress") echo"selected"; ?>>in_progress</option>
						<option <?php if( $task['status'] == "completed") echo"selected"; ?>>completed</option>
					</select><br>
				</div>
				<input type="text" name="id" value="<?=$task['id']?>" hidden>

				<button class="edit-btn">Update</button>
			</form>
			
		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(2)");
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