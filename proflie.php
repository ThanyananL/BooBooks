<?php
session_start();

$host = 'localhost';
$db_name = 'boobooks_272';
$username = 'boobooks_272';
$password = 'il1Gy8xZf';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if (!isset($_SESSION['loginuser_id'])) {
    header("Location: loginUser.php");
    exit;
}

$user_id = $_SESSION['loginuser_id'];

$sql = "SELECT b.* FROM favorites f INNER JOIN books b ON f.book_id = b.id WHERE f.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <a class="navbar-brand" href="index.php">BooBooks อ่านหนังสือฟรี</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">คลังหนังสือ</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['loginuser_id'])) { ?>
                                <a class="nav-link" href="proflie.php">ข้อมูลส่วนตัว</a>
                            <?php } else { ?>
                                <a class="nav-link" href="loginUser.php">Login</a>
                            <?php } ?>
                        </li>
                        <?php if (isset($_SESSION['loginuser_id'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logoutUser.php">ออกจากระบบ</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 class="m-3">My Favorites</h1>
        <div class="pdf-list d-flex flex-wrap">
            <?php if (count($favorites) > 0) { ?>
                <?php foreach ($favorites as $favorite) { ?>
                    <div class="card m-1">
                        <div class="card">
                            <img src="uploads/cover/<?php echo $favorite['cover']; ?>" class="card-img-top" alt="<?php echo $favorite['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $favorite['title']; ?></h5>
                                <p class="card-text"><?php echo $favorite['description']; ?></p>
                                <a href="remove_from_favorites.php?book_id=<?php echo $favorite['id']; ?>" class="btn btn-danger">Remove from Favorites</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="m-3 alert alert-info">
                    ยังไม่มีรายการโปรด
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>