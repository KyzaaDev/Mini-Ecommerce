<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #ede9fe;
        }
        .login {
            margin: 150px auto;
            background-color: #ffff;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .login label {
            display: block;
            margin-bottom: 4px;
        }
        .login input {
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #6b21a8 ;
            border-radius: 7px;
            padding: 8px;
            box-sizing: border-box;
        }
        .login button {
            width: 100%;
            margin-top: 15px;
            border: none;
            border-radius: 7px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #6b21a8;
            color: white;
        }
        .login button:hover {
            background-color: #4c1d95 ;
        }
        .login h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .login p {
            margin-top: 0;
            margin-bottom: 10px;
            text-align: center;
        }
        .login a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="../controllers/auth.php" method="post">
            <?php if(isset($_GET["error"])) :?>
                <p style="color: red; text-align:center;">Maaf password atau username salah</p>
            <?php endif; ?>
            <label for="username">Username: </label>
            <input type="text" name="user" id="username" required>
            <label for="password">Password: </label>
            <input type="password" name="pass" id="password" required>
            <p>Tidak punya akun? <a href="register.php">Daftar disini</a></p>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>