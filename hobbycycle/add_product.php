<?php
session_start();
include 'db.php';
if (!isset($_SESSION['is_login'])) { header("Location: index.php"); exit(); }

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    
    $image = $_FILES['image']['name'];
    $image_baru = rand(1,999) . '_' . str_replace(" ", "_", $image); 
    $target = "uploads/" . basename($image_baru);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (user_id, name, price, description, image) VALUES ('$user_id', '$name', '$price', '$desc', '$image_baru')";
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('Berhasil!'); window.location='inventory.php';</script>";
        } else {
            echo "Error DB: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Gagal Upload Gambar');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Jual Barang</title><link rel="stylesheet" href="style.css"></head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    
    <div class="container" style="width: 500px;">
        <h2 style="text-align: center; border-bottom: 1px solid #333; padding-bottom: 15px;">Jual Barang Baru</h2>
        
        <form method="POST" enctype="multipart/form-data">
            <label>Nama Barang</label>
            <input type="text" name="name" required>
            
            <label>Harga (Rp)</label>
            <input type="number" name="price" required>
            
            <label>Deskripsi Lengkap</label>
            <textarea name="description" required style="height: 100px;"></textarea>
            
            <label>Foto Produk</label>
            <input type="file" name="image" required style="padding: 5px;">
            
            <button type="submit" name="submit" style="margin-top: 20px;">JUAL SEKARANG</button>
            <a href="inventory.php" style="display:block; text-align:center; margin-top:15px; color:#888;">Batal</a>
        </form>
    </div>

</body>
</html>