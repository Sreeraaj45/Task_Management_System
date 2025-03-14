<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/Model/Notification.php";
    // include "app/Model/User.php";

    $notifications = get_all_my_notifications($conn, $_SESSION['id']);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Notifications</title>
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
            flex-direction: column;
			background: #f5f7fa;
        }

		.body {
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            animation: fadeIn 0.8s ease-in-out;
        }

		h4.title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 15px;
        }

		.success {
            background: #4CAF50;
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

        .main-table tr:last-child td {
            border-bottom: none;
        }

		h3 {
            text-align: center;
            color: #666;
            font-weight: 400;
            animation: fadeIn 0.6s ease-in-out;
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
			<h4 class="title">All Notifications</h4>
			<?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>
			<?php if ($notifications != 0) { ?>
			<table class="main-table">
				<tr>
					<th>#</th>
					<th>Message</th>
					<th>Type</th>
					<th>Date</th>
				</tr>
				<?php $i=0; foreach ($notifications as $notification) { ?>
				<tr>
					<td><?=++$i?></td>
					<td><?=$notification['message']?></td>
					<td><?=$notification['type']?></td>
					<td><?=$notification['date']?></td>
				</tr>
			   <?php	} ?>
			</table>
		<?php }else { ?>
			<h3>You have zero notification</h3>
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