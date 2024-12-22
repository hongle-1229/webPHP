<?php include '../config/db_connect.php'; ?>

<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: includes/login.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
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
        <h2>Danh sách sản phẩm</h2>
        <a href="../admin/action/add_product.php" class="btn btn-success mb-3">Thêm sản phẩm mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Phân loại</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $connect->query(" 
                    SELECT 
                        product_id, 
                        product_name, 
                        price, 
                        description,
                        category_name, 
                        image
                FROM 
                    products 
                JOIN 
                    categories  ON products.category_id = categories.category_id
                
            ");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['product_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['price']}</td>
                       <td>{$row['description']}</td>
                        <td>{$row['category_name']}</td>
                        <td>
                            <img src='{$row['image']}' alt='{$row['product_name']}' style='width: 100px; height: auto;'>
                        </td>
                        <td>
                            <a href='../admin/action/edit_product.php?product_id={$row['product_id']}' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='#' class='btn btn-danger btn-sm' onclick='confirmDelete({$row['product_id']})'>Xóa</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(productId) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Sản phẩm này sẽ bị xóa vĩnh viễn!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Chuyển hướng tới liên kết xóa sản phẩm
            window.location.href = `../admin/action/delete_product.php?product_id=${productId}`;
        }
    });
}
</script>
</body>
</html>
