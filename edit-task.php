<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
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

		h4.title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h4.title a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
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
			<h4 class="title">Edit Task <a href="tasks.php">Back</a></h4>
			<form class="form-1"
			      method="POST"
			      action="app/update-task.php">
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
					<lable>Title</lable>
					<input type="text" name="title" class="input-1" placeholder="Full Name" value="<?=$task['title']?>"><br>
				</div>
				<div class="input-holder">
					<lable>Description</lable>
					<textarea name="description" rows="5" class="input-1" ><?=$task['description']?></textarea><br>
				</div>
				<div class="input-holder">
					<lable>Snooze</lable>
					<input type="date" name="due_date" class="input-1" placeholder="Snooze" value="<?=$task['due_date']?>"><br>
				</div>
				
            <div class="input-holder">
					<lable>Assigned to</lable>
					<select name="assigned_to" class="input-1">
						<option value="0">Select employee</option>
						<?php if ($users !=0) { 
							foreach ($users as $user) {
								if ($task['assigned_to'] == $user['id']) { ?>
									<option selected value="<?=$user['id']?>"><?=$user['full_name']?></option>
						<?php }else{ ?>
                  <option value="<?=$user['id']?>"><?=$user['full_name']?></option>
						<?php } } } ?>
					</select><br>
				</div>
				<input type="text" name="id" value="<?=$task['id']?>" hidden>

				<button class="edit-btn">Update</button>
			</form>
			
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