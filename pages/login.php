<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/loginstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="../controllers/auth/auth_login.php" method="post">
            <?php if(isset($_GET["error"]) && $_GET["error"] == "wrong") :?>
                <div class="alert alert-danger" role="alert">Lah salah tuh username ataw passwordnya</div>
            <?php elseif (isset($_GET["register_success"]) && $_GET["register_success"] == "success") :?>
                <div class="alert alert-success" role="alert">Kelas kink, sudah saatnya Login</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] == "not_found") :?>
                <div class="alert alert-danger" role="alert">Bikin akun dulu bang baru login</div>
            <?php endif; ?>

            <li>
                <input class="form-control mb-3" type="text" name="user" id="username" required placeholder="Username">
            </li>
            <li>
                <input class="form-control mb-3" type="password" name="pass" id="password" required placeholder="Password">
            </li>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember" >Remember me</label>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
        <p>Tidak punya akun? <a href="register.php">Daftar disini</a></p>
    </div>
</body>
</html>