
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Liên kết đến file CSS -->
</head>
<body>
    <header>
        <h1>Quản lý sinh viên</h1>
        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="add.php">Thêm sinh viên</a></li>
                <li><a href="dangky.php">Đăng ký học phần</a></li>
                <li><a href="hocphan.php">Học phần đã đăng ký</a></li>
                <?php if (isset($_SESSION['mssv'])): ?>
                    <li><a href="logout.php">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="dangnhap.php">Đăng nhập</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main></main>