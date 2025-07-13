<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/loginstyle.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="../controllers/auth/auth_login.php" method="post">
            <?php if(isset($_GET["error"]) && $_GET["error"] == "wrong") :?>
                <p style="color: red; text-align:center;">Maaf password atau username salah</p>
            <?php elseif (isset($_GET["register_success"]) && $_GET["register_success"] == "success") :?>
                <p style="color: green; text-align:center;">Berhasil register! silahkan login</p>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] == "not_found") :?>
                <p style="color: red; text-align:center;">Akun tidak ditemukan, silahkan daftar terlebih dahulu</p>
            <?php endif; ?>

            <label for="username">Username </label>
            <input type="text" name="user" id="username" required placeholder="Username">
            <label for="password">Password </label>
            <input type="password" name="pass" id="password" required placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
        <p>Tidak punya akun? <a href="register.php">Daftar disini</a></p>
    </div>
</body>
</html>