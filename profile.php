<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "DB_connection.php";
    include "app/Model/User.php";
    $user = get_user_by_id($conn, $_SESSION['id']);
    
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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

        .main-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            animation: slideUp 0.6s ease-in-out;
            max-width: 300px;
            margin: 0 auto;
        }

        .main-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            font-weight: 500;
        }

        .main-table tr:last-child td {
            border-bottom: none;
        }

        .main-table td:first-child {
            font-weight: 600;
            color: #555;
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
			<h4 class="title">Profile <a href="edit_profile.php">Edit Profile</a></h4>
         <table class="main-table" style="max-width: 300px;">
				<tr>
					<td>Full Name</td>
					<td><?=$user['full_name']?></td>
				</tr>
				<tr>
					<td>User name</td>
					<td><?=$user['username']?></td>
				</tr>
				<tr>
					<td>Joined At</td>
					<td><?=$user['created_at']?></td>
				</tr>
			</table>

		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(3)");
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