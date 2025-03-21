<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Bắt đầu session để kiểm tra đăng nhập
if (!isset($_SESSION['mssv'])) {
    header("Location: dangnhap.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}
include 'C:\Users\HoangQuan\Desktop\KiemTraSangT6\app\header.php';
include 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Lấy danh sách sinh viên
$sql = "SELECT * FROM SinhVien";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <h1>Danh sách sinh viên</h1>
    <a href="add.php">Thêm sinh viên</a>
    <table border="1">
        <tr>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Hình ảnh</th>
            <th>Mã ngành</th>
            <th>Thao tác</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['MaSV']; ?></td>
            <td><?php echo $row['HoTen']; ?></td>
            <td><?php echo $row['GioiTinh']; ?></td>
            <td><?php echo $row['NgaySinh']; ?></td>
            <td><img src="<?php echo $row['Hinh']; ?>" width="100"></td>
            <td><?php echo $row['MaNganh']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['MaSV']; ?>">Sửa</a> |
                <a href="delete.php?id=<?php echo $row['MaSV']; ?>" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                Xóa
            </a> |
                <a href="detail.php?id=<?php echo $row['MaSV']; ?>">Chi tiết</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>