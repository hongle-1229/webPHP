<?php include '../../config/db_connect.php'; ?>

<?php
$id = $_GET['product_id'];
$result = $connect->query("SELECT * FROM products WHERE product_id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $connect->prepare("UPDATE products SET product_name = ?, price = ?, description = ? WHERE product_id = ?");
    $stmt->bind_param("sdsi", $product_name, $price, $description, $id);
    $stmt->execute();

    header("Location: ../manager_product.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Sửa sản phẩm</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>" required>

            <!-- <input type="text" name="name" class="form-control" value="<?= $product['product_name'] ?>" required> -->
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="../manager_product.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
