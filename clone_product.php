<?php include '../config/db_connect.php'; ?>

<?php
// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$result = $connect->query("SELECT * FROM products");
$brands = $connect->query("SELECT *FROM brands");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-indigo-600">Ankyo</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="../index.php" class="hover:text-indigo-600">Trang Chủ</a></li>
                    <li><a href="includes/product.php" class="hover:text-indigo-600">Sản Phẩm</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Bài viết</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-lg font-bold mb-3">Thương Hiệu</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="product.php" class="text-decoration-none">Tất cả</a>
                    </li>
                    <?php while ($brand = $brands->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <a href="product.php?brand=<?= urlencode($brand['brand_name']) ?>" 
                               class="text-decoration-none <?= $selected_brand == $brand['brand_name'] ? 'text-primary' : '' ?>">
                                <?= htmlspecialchars($brand['brand_name']) ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

    <div class="container mt-5">
        <h1 class="text-4xl font-bold text-gray-700 hover:text-red-500 transition-colors
        text-center mb-5">Danh Sách Sản Phẩm</h1>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['product_name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-xl font-medium text-black-700 hover:text-red-500 transition-colors"><?= $row['product_name'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                            <p class="card-text mb-3    "><strong>Giá:</strong> <?= number_format($row['price'], 6, ',', '.') ?> VNĐ</p>
                            <a href="product_detail.php?product_id=<?= $row['product_id'] ?>" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer class="bg-gray-800 text-gray-300 py-6">
    <div >

    </div>
    <div class="container mx-auto text-center">
      <p>© 2024 Ankyo. All rights reserved.</p>
    </div>
  </footer>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>