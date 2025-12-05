<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah dipakai!');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Daftar Akun</title><link rel="stylesheet" href="style.css"></head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    
    <div class="container" style="width: 400px; text-align: center; margin: 0;">
        <h2 style="color: #d00000; margin-bottom: 5px;">HobbyCycle</h2>
        <p style="color: #888; margin-bottom: 30px;">Bergabung dengan komunitas kami</p>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Username Baru" required>
            <input type="email" name="email" placeholder="Email Aktif" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <button type="submit" name="register" style="width: 100%; margin-top: 10px;">DAFTAR SEKARANG</button>
        </form>
        
        <br>
        <div style="font-size: 14px; color: #888;">
            Sudah punya akun? <a href="login.php" style="color: #d00000;">Login</a>
        </div>
        <br>
        <a href="index.php" style="color: #555; font-size: 12px;">&larr; Kembali ke Home</a>
    </div>

</body>
</html>