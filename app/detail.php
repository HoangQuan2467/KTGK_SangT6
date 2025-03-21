<?php
include 'config/database.php';
include 'C:\Users\HoangQuan\Desktop\KiemTraSangT6\app\header.php';
$database = new Database();
$conn = $database->getConnection();

$id = $_GET['id'];
$sql = "SELECT * FROM SinhVien WHERE MaSV=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Thông tin chi tiết sinh viên</h1>
    <p>Mã SV: <?php echo $row['MaSV']; ?></p>
    <p>Họ tên: <?php echo $row['HoTen']; ?></p>
    <p>Giới tính: <?php echo $row['GioiTinh']; ?></p>
    <p>Ngày sinh: <?php echo $row['NgaySinh']; ?></p>
    <p>Hình ảnh: <img src="<?php echo $row['Hinh']; ?>" width="100"></p>
    <p>Mã ngành: <?php echo $row['MaNganh']; ?></p>
    <a href="index.php">Quay lại</a>
</body>
</html>