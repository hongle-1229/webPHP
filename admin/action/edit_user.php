<?php include '../../config/db_connect.php'; ?>

<?php
$id = $_GET['user_id'];  // Lấy id người dùng từ URL
$result = $connect->query("SELECT * FROM users WHERE user_id = $id");  // Truy vấn lấy thông tin người dùng theo id
$user = $result->fetch_assoc();  // Lấy dữ liệu người dùng

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Mã hóa mật khẩu

    // Sử dụng câu lệnh chuẩn để bảo mật khi cập nhật thông tin người dùng
    $stmt = $connect->prepare("UPDATE users SET userName = ?, password = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $userName, $password, $role, $id);  // Tham số là chuỗi (string) và số (integer)
    $stmt->execute();  // Thực thi câu lệnh

    header("Location: ../manager_user.php");  // Chuyển hướng về trang quản lý người dùng
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Sửa thông tin người dùng</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="userName" class="form-label">Tên người dùng</label>
            <input type="text" name="userName" class="form-control" value="<?= $user['userName'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="text" name="password" class="form-control" value="<?= $user['password'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select name="role" class="form-control" required>
                <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="../manager_user.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
