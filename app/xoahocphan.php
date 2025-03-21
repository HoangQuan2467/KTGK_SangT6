<?php
include 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

$id = $_GET['id'];
$sql = "DELETE FROM chitietdangky WHERE MaDK=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

if ($stmt) {
    header("Location: hocphan.php");
} else {
    echo "Lỗi khi xóa sinh viên!";
}
?>