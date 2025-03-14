<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Task Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
	<style>
		* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #007BFF, #00C6FF);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        .login-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }

        h3 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            color: #007BFF;
            animation: slideDown 0.6s ease-in-out;
        }

        .alert {
            animation: fadeIn 0.5s ease-in;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
	</style>
</head>
<body class="login-body">
      
      <form method="POST" action="app/login.php" class="shadow p-4">

      	  <h3 class="display-4">LOGIN</h3>
      	  <?php if (isset($_GET['error'])) {?>
      	  	<div class="alert alert-danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="alert alert-success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } 

                // $pass = "123";
                // $pass = password_hash($pass, PASSWORD_DEFAULT);
                // echo $pass;
      
      	  ?>
  
			
		  <div class="mb-3">
		    <label for="exampleInputEmail1" class="form-label">User name</label>
		    <input type="text" class="form-control" name="user_name">
		  </div>
		  <div class="mb-3">
		    <label for="exampleInputPassword1" class="form-label">Password</label>
		    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
		  </div>
		  <button type="submit" class="btn btn-primary">Login</button>
		</form>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>