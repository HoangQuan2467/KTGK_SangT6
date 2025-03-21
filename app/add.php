<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Bắt đầu session để kiểm tra đăng nhập
if (!isset($_SESSION['mssv'])) {
    header("Location: dangnhap.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

include 'config/database.php';
include 'C:\Users\HoangQuan\Desktop\KiemTraSangT6\app\header.php';
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $hinh = $_POST['hinh'];
    $maNganh = $_POST['maNganh'];

    // Kiểm tra xem MSSV đã tồn tại chưa
    $sql_check = "SELECT MaSV FROM SinhVien WHERE MaSV = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute([$maSV]);

    if ($stmt_check->rowCount() > 0) {
        $error_message = "MSSV đã tồn tại!";
    } else {
        // Thêm sinh viên mới
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh]);

        if ($stmt) {
            header("Location: index.php"); // Chuyển hướng về trang chủ sau khi thêm thành công
            exit();
        } else {
            $error_message = "Lỗi khi thêm sinh viên!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Thêm sinh viên</h1>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post">
        Mã SV: <input type="text" name="maSV" required><br>
        Họ tên: <input type="text" name="hoTen" required><br>
        Giới tính: <input type="text" name="gioiTinh" required><br>
        Ngày sinh: <input type="date" name="ngaySinh" required><br>
        Hình ảnh: <input type="text" name="hinh" required><br>
        Mã ngành: <input type="text" name="maNganh" required><br>
        <input type="submit" value="Thêm">
    </form>
</body>
</html>