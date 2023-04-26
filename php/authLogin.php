<?php
session_start();
require_once "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        header("Location: ../loginUser.php?error=กรุณากรอกข้อมูลอีเมลและรหัสผ่านให้ครบถ้วน");
        exit;
    }

    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row["password"])) {
            $_SESSION["loginuser_id"] = $row["id"];
            $_SESSION["loginuser_email"] = $row["email"];
            header("Location: ../index.php");
            exit;
        } else {
            header("Location: ../loginUser.php?error=รหัสผ่านไม่ถูกต้อง");
            exit;
        }
    } else {
        header("Location: ../loginUser.php?error=ไม่พบผู้ใช้งานที่มีอีเมลนี้");
        exit;
    }
}
?>
