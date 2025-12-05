<?php
session_start();
include 'db.php';

if (!isset($_SESSION['is_login'])) {
    echo "<script>alert('Harap Login dulu untuk membeli!'); window.location='login.php';</script>";
    exit();
}

$product_id = $_GET['id'];
$user_id    = $_SESSION['user_id'];

$cek = mysqli_query($conn, "SELECT * FROM products WHERE id='$product_id' AND status='available'");

if (mysqli_num_rows($cek) > 0) {
    
    mysqli_query($conn, "INSERT INTO transactions (user_id, product_id) VALUES ('$user_id', '$product_id')");
    
    mysqli_query($conn, "UPDATE products SET status='sold' WHERE id='$product_id'");

    echo "<script>alert('Pembelian Berhasil! Terima kasih.'); window.location='orders.php';</script>";

} else {
    echo "<script>alert('Maaf, barang ini sudah terjual!'); window.location='index.php';</script>";
}
?>