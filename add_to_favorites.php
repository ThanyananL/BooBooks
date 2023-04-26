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
$book_id = $_GET['book_id'];

try {
    $sql = "INSERT INTO favorites (user_id, book_id) VALUES (:user_id, :book_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $user_id, ':book_id' => $book_id]);
    header("Location: proflie.php");
    exit;
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) { // 1062 is the error code for duplicate entry
        header("Location: proflie.php?error=หนังสือนี้ถูกเพิ่มในรายการโปรดแล้ว");
        exit;
    } else {
        // Handle other types of exceptions
        header("Location: proflie.php?error=เกิดข้อผิดพลาดในการเพิ่มหนังสือเข้ารายการโปรด");
        exit;
    }
}

?>
