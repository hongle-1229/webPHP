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
<style>
    
</style>
<body>
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-indigo-600">Ankyo</h1>
            <nav>
                <ul class="flex space-x-4 font-bold text-xl">
                    <li><a href="../index.php" class="hover:text-indigo-600">Trang Chủ</a></li>
                    <li><a href="includes/product.php" class="hover:text-indigo-600">Sản Phẩm</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Bài viết</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container-fluid mt-3">
    <div class="row">
        <!-- Navbar bên trái: Thương hiệu -->
        <nav class="col-md-2 bg-light py-4">
            <h5 class="font-bold mb-4 text-2xl" style="padding-left: 65px">Thương Hiệu</h5>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action active" data-brand="all" style="cursor: pointer;">Tất cả thương hiệu</li>
                <?php
                $sqlBrands = "SELECT brand_id, brand_name FROM brands";
                $brandsResult = $connect->query($sqlBrands);
                while ($brand = $brandsResult->fetch_assoc()) {
                ?>
                    <li class="list-group-item list-group-item-action" data-brand="<?php echo $brand['brand_id']; ?>" style="cursor: pointer;">
                        <?php echo ucfirst($brand['brand_name']); ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Nội dung chính: Danh mục và Sản phẩm -->
        <div class="col-md-10">
            <!-- Phần danh mục -->
            <h5 class="text-center text-4xl font-bold mb-4" style="padding-top: 30px">Danh Mục Sản Phẩm</h5>
            <ul class="nav nav-pills justify-content-center mb-5" id="productCategoryTab">
                <li class="nav-item">
                    <button class="nav-link active font-bold text-xl" data-category="all">Tất cả sản phẩm</button>
                </li>
                <?php
                $sqlCategories = "SELECT category_id, category_name FROM categories";
                $categoriesResult = $connect->query($sqlCategories);
                while ($category = $categoriesResult->fetch_assoc()) {
                ?>
                    <li class="nav-item">
                        <button class="nav-link font-bold text-xl" data-category="<?php echo $category['category_id']; ?>">
                            <?php echo ucfirst($category['category_name']); ?>
                        </button>
                    </li>
                <?php } ?>
            </ul>

            <!-- Danh sách sản phẩm -->
            <div id="productList" class="row">
                <?php
                $sqlProducts = "
                    SELECT p.product_id, p.product_name, p.price, p.image, p.category_id, p.brand_id 
                    FROM products p";
                $productsResult = $connect->query($sqlProducts);
                while ($product = $productsResult->fetch_assoc()) {
                ?>
                    <div class="col-md-4 product-item" data-category="<?php echo $product['category_id']; ?>" data-brand="<?php echo $product['brand_id']; ?>">
                        <div class="card mb-5
                        ">
                            <img src="<?php echo $product['image'] ? $product['image'] : 'default.jpg'; ?>" class="card-img-top" alt="<?php echo $product['product_name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                <p class="card-text"><?php echo number_format($product['price'], 6, ',', '.'); ?> VNĐ</p>
                                <button class="btn btn-success">Quan tâm</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


    <footer class="bg-gray-800 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p>© 2024 Ankyo. All rights reserved.</p>
        </div>
    </footer>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll('[data-category]');
    const brandButtons = document.querySelectorAll('[data-brand]');
    const products = document.querySelectorAll('.product-item');

    let selectedCategory = 'all';
    let selectedBrand = 'all';

    // Hàm lọc sản phẩm
    function filterProducts() {
        products.forEach(product => {
            const productCategory = product.getAttribute('data-category');
            const productBrand = product.getAttribute('data-brand');

            const categoryMatch = (selectedCategory === 'all' || productCategory === selectedCategory);
            const brandMatch = (selectedBrand === 'all' || productBrand === selectedBrand);

            if (categoryMatch && brandMatch) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Xử lý sự kiện lọc danh mục
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedCategory = button.getAttribute('data-category');
            filterProducts();
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });

    // Xử lý sự kiện lọc thương hiệu
    brandButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedBrand = button.getAttribute('data-brand');
            filterProducts();
            brandButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
});
</script>


    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>