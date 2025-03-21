<?php
include 'config/database.php';
include 'C:\Users\HoangQuan\Desktop\KiemTraSangT6\app\header.php';
$database = new Database();
$conn = $database->getConnection();

// Lấy danh sách học phần đã đăng ký
$sql = "SELECT HocPhan.MaHP, HocPhan.TenHP, HocPhan.SoTinChi 
        FROM ChiTietDangKy 
        JOIN HocPhan ON ChiTietDangKy.MaHP = HocPhan.MaHP";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Học phần đã đăng ký</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Học phần đã đăng ký</h1>
    <table border="1">
        <tr>
            <th>Mã HP</th>
            <th>Tên HP</th>
            <th>Số tín chỉ</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['MaHP']; ?></td>
            <td><?php echo $row['TenHP']; ?></td>
            <td><?php echo $row['SoTinChi']; ?></td>
            <td>
                <a href="xoahocphan.php?id=<?php echo $row['MaHP']; ?>">Xóa</a> |
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>