<?php
include 'config/database.php';
include 'C:\Users\HoangQuan\Desktop\KiemTraSangT6\app\header.php';
$database = new Database();
$conn = $database->getConnection();

// Truy vấn lấy tất cả học phần
$sql = "SELECT MaHP, TenHP, SoTinChi FROM HocPhan";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách học phần</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Danh sách học phần</h1>
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
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
