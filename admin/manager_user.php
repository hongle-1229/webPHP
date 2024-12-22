<?php include '../config/db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
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
    position: sticky; /* Sidebar cố định */
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
    overflow-y: auto; /* Bật cuộn cho nội dung */
    padding: 20px;
    background-color: #f8f9fa;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Quản lý</h3>
        <a href="../admin/manager_product.php">Quản lý sản phẩm</a>
        <a href="../admin/manager_user.php">Quản lý người dùng</a>
        <a href="orders.php">Quản lý đơn hàng</a>
        <a href="../logout.php" class="btn btn-danger mt-auto mx-3">Đăng xuất</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <h2>Danh sách người dùng</h2>
        <a href="../admin/action/add_user.php" class="btn btn-success mb-3">Thêm người dùng mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Mật khẩu</th>
                    <th>Email</th>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $connect->query(" 
                    SELECT 
                        user_id, 
                        userName, 
                        password, 
                        email, 
                        fullName, 
                        phoneNumber,
                        role,
                        status
                FROM 
                    users 
            ");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['userName']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['fullName']}</td>
                        <td>{$row['phoneNumber']}</td>
                        <td>{$row['role']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='../admin/action/edit_user.php?user_id={$row['user_id']}' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='../admin/action/delete_user.php?user_id={$row['user_id']}' class='btn btn-danger btn-sm'>Xóa</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
