<?php include'../../config/db_connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng Mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: sticky;
            /* Sidebar cố định */
            top: 0;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            overflow-y: auto;
            /* Bật cuộn cho nội dung */
            padding: 20px;
            background-color: #f8f9fa;
        }

        .content h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 5px;
            font-weight: 600;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Quản lý</h3>
        <a href="../manager_product.php">Quản lý sản phẩm</a>
        <a href="../manager_user.php">Quản lý người dùng</a>
        <a href="orders.php">Quản lý đơn hàng</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <h2>Thêm Người Dùng Mới</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Nhận dữ liệu từ form
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullName = $_POST['fullName'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];
            $role = $_POST['role'];
            $status = $_POST['status'];

            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Chèn dữ liệu người dùng mới vào cơ sở dữ liệu
            $stmt = $connect->prepare("INSERT INTO users (userName, password, email, fullName, phoneNumber, address, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $userName, $hashedPassword, $email, $fullName, $phoneNumber, $address, $role, $status);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Người dùng mới đã được thêm thành công!</div>";
            } else {
                echo "<div class='alert alert-danger'>Có lỗi xảy ra, vui lòng thử lại!</div>";
            }
        }
        ?>

        <form method="POST" class="shadow-sm p-4 mb-4 bg-white rounded">
            <div class="form-group">
                <label for="userName" class="form-label">Tên đăng nhập</label>
                <input type="text" name="userName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fullName" class="form-label">Họ và tên</label>
                <input type="text" name="fullName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="text" name="phoneNumber" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Vai trò</label>
                <select name="role" class="form-select" required>
                    <option value="user">Người dùng</option>
                    <option value="admin">Quản trị viên</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="1">Kích hoạt</option>
                    <option value="0">Tạm ngưng</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Thêm người dùng</button>
            <a href="../manager_user.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>