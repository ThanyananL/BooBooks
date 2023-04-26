<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
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
<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="admin.php">BooBooks Admin</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">คลังหนังสือ</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-book.php">เพิ่มหนังสือ</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-category.php">เพิ่มหมวดหมู่</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-author.php">เพิ่มสำนักงาน / ผู้แต่ง</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">ออกจากระบบ</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-author.php"
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 80%;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		เพิ่มผู้แต่งใหม่
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           	ชื่อผู้แต่ง
		           </label>
		    <input type="text" 
		           class="form-control" 
		           name="author_name">
		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            เพิ่มผู้แต่ง</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>