<?php  
session_start();

# If the admin is logged in
if (!isset($_SESSION['loginuser_id']) &&
    !isset($_SESSION['loginuser_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BooBooks</title>

	<!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- bootstrap 5 Js bundle CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@300;500&display=swap" rel="stylesheet">

	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<div class="d-flex justify-content-center align-items-center"
	     style="min-height: 100vh;">
		<form class="p-5 rounded shadow"
		      style="max-width: 30rem; width: 100%"
		      method="POST"
		      action="php/authLogin.php">

		  <h1 class="text-center display-4 pb-5">LOGIN</h1>
		  <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		  <?php } ?>

		  <div class="mb-3">
		    <label for="exampleInputEmail1" 
		           class="form-label">อีเมล</label>
		    <input type="email" 
		           class="form-control" 
		           name="email" 
		           id="exampleInputEmail1" 
		           aria-describedby="emailHelp">
		  </div>

		  <div class="mb-3">
		    <label for="exampleInputPassword1" 
		           class="form-label">รหัสผ่าน</label>
		    <input type="password" 
		           class="form-control" 
		           name="password" 
		           id="exampleInputPassword1">
		  </div>
		  <button type="submit" 
		          class="btn btn-primary">
		          Login</button>
        <a href="register.php" class="btn btn-info">Register</a>
		</form>
	</div>
</body>
</html>

<?php }else{
  header("Location: index.php");
  exit;
} ?>