<?php
session_start();

if (!isset($_SESSION['loginuser_id']) && !isset($_SESSION['loginuser_email'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $servername = "localhost";
        $username = "boobooks_272";
        $password = "il1Gy8xZf";
        $dbname = "boobooks_272";

        // สร้างการเชื่อมต่อ
        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // รับข้อมูลจากแบบฟอร์ม
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // เข้ารหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // สร้างคำสั่ง SQL
        $sql = "INSERT INTO `user` (full_name, email, password) VALUES (?, ?, ?)";

        // ใช้ prepared statement เพื่อป้องกัน SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $full_name, $email, $hashed_password);

        // ประมวลผลคำสั่ง SQL และตรวจสอบสถานะ
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "มีข้อผิดพลาดในการลงทะเบียน: " . $conn->error;
        }

        // ปิดการเชื่อมต่อ
        $stmt->close();
        $conn->close();
    }
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
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" method="POST" action="register.php">

                <h1 class="text-center display-4 pb-5">REGISTER</h1>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <label for="full_name" class="form-label">ชื่อ-นามสกุล:</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required><br><br>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล:</label>
                    <input type="email" name="email" id="email" class="form-control" required><br><br>
                </div>
                <div class="mb-3">

                    <label for="password" class="form-label">รหัสผ่าน:</label>
                    <input type="password" name="password" id="password" class="form-control" required><br><br>

                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                
                <a href="loginUser.php" class="btn btn-info">Login</a>
            </form>
        </div>
    </body>

    </html>

<?php } else {
    header("Location: loginUser.php");
    exit;
} ?>