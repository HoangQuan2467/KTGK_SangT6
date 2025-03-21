<?php
session_start(); // Bắt đầu session nếu chưa có

// Hủy toàn bộ session
session_unset();
session_destroy();

// Chuyển hướng về trang đăng nhập
header("Location: dangnhap.php");
exit();
?>