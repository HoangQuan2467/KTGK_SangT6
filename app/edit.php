<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Bắt đầu session để kiểm tra đăng nhập
if (!isset($_SESSION['mssv'])) {
    header("Location: dangnhap.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

include 'config/database.php';
include 'header.php';
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $hinh = $_POST['hinh'];
    $maNganh = $_POST['maNganh'];

    // Cập nhật thông tin sinh viên
    $sql = "UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh, $maSV]);

    if ($stmt) {
        header("Location: index.php"); // Chuyển hướng về trang chủ sau khi cập nhật thành công
        exit();
    } else {
        $error_message = "Lỗi khi cập nhật thông tin!";
    }
}

$id = $_GET['id']; // Lấy MSSV từ URL
$sql = "SELECT * FROM SinhVien WHERE MaSV=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Không tìm thấy sinh viên!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Sửa thông tin sinh viên</h1>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post">
        Mã SV: <input type="text" name="maSV" value="<?php echo $row['MaSV']; ?>" readonly><br>
        Họ tên: <input type="text" name="hoTen" value="<?php echo $row['HoTen']; ?>"><br>
        Giới tính: <input type="text" name="gioiTinh" value="<?php echo $row['GioiTinh']; ?>"><br>
        Ngày sinh: <input type="date" name="ngaySinh" value="<?php echo $row['NgaySinh']; ?>"><br>
        Hình ảnh: <input type="text" name="hinh" value="<?php echo $row['Hinh']; ?>"><br>
        Mã ngành: <input type="text" name="maNganh" value="<?php echo $row['MaNganh']; ?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>