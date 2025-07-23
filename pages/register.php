<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/registerstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="register-card">
        <h1>Register</h1>
        <form action="../controllers/auth/auth_register.php" method="post">
            <?php if (isset($_GET["error"]) && $_GET["error"] === "username_exist")  :?>
                <div class="alert alert-danger" role="alert">Yahh usernamenya udah dipake</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "invalid_email")  :?>
                <div class="alert alert-danger" role="alert">Masukin email yang bener dong!</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "insert_failed")  :?>
                <div class="alert alert-danger" role="alert">Waduh, gagal bikin akun. Coba lagi nanti ya!!</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "email_exist")  :?>
                <div class="alert alert-danger" role="alert">Lho, udah ada yang pake emailnya nih</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "password_too_short")  :?>
                <div class="alert alert-danger" role="alert">Walawe, kependekan passwordnya</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "password_not_match")  :?>
                <div class="alert alert-danger" role="alert">Masa ngecocokin password aja gabisa</div>
            <?php elseif (isset($_GET["error"]) && $_GET["error"] === "empty_fields")  :?>
                <div class="alert alert-danger" role="alert">Masa ngecocokin password aja gabisa</div>
            <?php endif?>
    

            
            <input class="form-control mb-3" type="text" name="email" id="email" placeholder="example@gmail.com" required>
            <input class="form-control mb-3" type="text" name="username" id="username" placeholder="Username" required>
            <input class="form-control mb-3" type="password" name="password" id="pass" placeholder="Password" required>
            <input class="form-control mb-3" type="password" name="password-confirm" id="conf-pass" placeholder="Confirm password" required>

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