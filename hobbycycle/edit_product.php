<?php
session_start();
include 'db.php';
if (!isset($_SESSION['is_login'])) { header("Location: index.php"); exit(); }

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    mysqli_query($conn, "UPDATE products SET name='$name', price='$price', description='$desc' WHERE id=$id");
    header("Location: inventory.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Barang</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="auth-wrapper">
        <div class="container" style="width: 500px;">
            <h2>Edit Barang</h2>
            <form method="POST">
                <label style="float:left">Nama Barang</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
                
                <label style="float:left">Harga</label>
                <input type="number" name="price" value="<?php echo $data['price']; ?>" required>
                
                <label style="float:left">Deskripsi</label>
                <textarea name="description" rows="3" required><?php echo $data['description']; ?></textarea>
                
                <button type="submit" name="update" style="background:#ffc107; color:black;">Update Data</button>
                <a href="inventory.php" class="link">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>