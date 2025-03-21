<?php
include 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

$id = $_GET['id'];
$sql = "DELETE FROM SinhVien WHERE MaSV=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

if ($stmt) {
    header("Location: index.php");
} else {
    echo "Lỗi khi xóa sinh viên!";
}
?>