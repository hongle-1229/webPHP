<?php include '../../config/db_connect.php'; ?>

<?php
$id = $_GET['product_id'];
$connect->query("DELETE FROM products WHERE product_id = $id");

header("Location: ../manager_product.php");
exit();
?>
