<?php
session_start(); // Đảm bảo luôn gọi session_start()

include 'config/database.php'; // Kết nối đến cơ sở dữ liệu

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mssv = $_POST['mssv']; // Lấy MSSV từ form đăng nhập

    // Kiểm tra xem MSSV có tồn tại trong bảng SinhVien hay không
    $sql = "SELECT MaSV FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$mssv]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['mssv'] = $mssv; // Lưu MSSV vào session
        header("Location: index.php");
        exit();
    } else {
        $error_message = "MSSV không tồn tại. Vui lòng kiểm tra lại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Đăng nhập</h1>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post">
        MSSV: <input type="text" name="mssv" required><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
