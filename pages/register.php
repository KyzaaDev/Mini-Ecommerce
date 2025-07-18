<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/registerstyle.css">
</head>
<body>
    <div class="register-card">
        <h1>Register</h1>
        <form action="../controllers/auth/auth_register.php" method="post">
            <?php if (isset($_GET["error"]) && $_GET["error"] === "username_exist")  :?>
                <p style="color: red; text-align:center;"> Username sudah terpakai</p>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "invalid")  :?>
                <p style="color: red; text-align:center;"> Pastikan email yang diinputkan valid</p>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "insert_failed")  :?>
                <p style="color: red; text-align:center;">Gagal membuat akun</p>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "already_used")  :?>
                <p style="color: red; text-align:center;">Email sudah terdaftar</p>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "terlalu_pendek")  :?>
                <p style="color: red; text-align:center;">Password yang dibuat minimal 8 character</p>
            <?php endif?>


            <label for="nama">Nama lengkap </label>
            <input type="text" name="nama" id="nama" required placeholder="Nama lengkap"> 
    
            <label for="email">Email </label>
            <input type="text" name="email" id="email" placeholder="example@gmail.com" required>
    
            <label for="username">Username </label>
            <input type="text" name="username" id="username" required placeholder="Username">
    
            <label for="pass">Password </label>
            <input type="password" name="pass" id="pass" required placeholder="Password">
    
            <div class="checkbox-wrapper">
                <input type="checkbox" id="persetujuan" name="persetujuan" required>
                <label for="persetujuan">I agree all terms & conditions</label>
            </div>

    
            <button type="submit" name="regis">Register</button>
        </form>
        <p>Sudah punya akun?, <a href="./login.php">login disini</a></p>

        
    </div>
</body>
</html>